<?php

/**
 * PHP version 7.3
 *
 * @category ClientTest
 * @package  Simla\Tests\Client
 */
namespace RetailCrm\Tests\Client;

use Http\Message\RequestMatcher\CallbackRequestMatcher;
use Simla\Builder\ClientBuilder;
use Simla\Model\Request\GetOrderListRequest;
use Simla\Model\Response\ErrorResponseBody;
use Simla\Model\Response\GetOrderListResponse;
use RetailCrm\Test\RequestMatcher;
use RetailCrm\Test\TestCase;

/**
 * Class ClientTest
 *
 * @category ClientTest
 * @package  Simla\Tests\Client
 */
class ClientTest extends TestCase
{
    public function testClientRequestException(): void
    {
        $errorBody = new ErrorResponseBody();
        $errorBody->code = 999;
        $errorBody->message = 'Mocked error';
        $errorResponse = new GetOrderListResponse();
        $errorResponse->errorResponse = $errorBody;

        $mockClient = self::getMockClient();
        $mockClient->on(new CallbackRequestMatcher(function () {
            return true;
        }), $this->responseJson(400, $errorResponse));

        $client = ClientBuilder::create()
            ->setContainer($this->getContainer($mockClient))
            ->setAppData($this->getEnvAppData())
            ->build();

        $this->expectExceptionMessage($errorBody->message);

        $client->sendRequest(new GetOrderListRequest());
    }

    public function testGetOrderList(): void
    {
        $mock = self::getMockClient();
        $mock->on(
            RequestMatcher::createMatcher('openapi.aliexpress.ru')
                ->setPath('/seller-api/v1/order/get-order-list'),
            $this->responseJson(200, $this->getOrderJson())
        );
        $client = ClientBuilder::create()
            ->setContainer($this->getContainer($mock))
            ->setAppData($this->getEnvAppData())
            ->build();
        $query = new GetOrderListRequest();
        $query->pageSize = 20;
        $query->page = 1;

        /** @var GetOrderListResponse $response */
        $response = $client->sendRequest($query);
        $data = $response->responseData;

        self::assertNotNull($data);
        self::assertEquals(1, $data->totalCount);
        self::assertCount(1, $data->orders);
        self::assertCount(1, $data->orders[0]->orderLines);
        self::assertEquals(2207216760272635, $data->orders[0]->orderLines[0]->id);
    }

    private function getOrderJson(): string
    {
        return <<<'EOF'
{
  "data": {
    "total_count": 1,
    "orders": [
      {
        "id": 2207214066364364,
        "created_at": "2022-07-21T11:25:38.782222+00:00",
        "paid_at": "2022-07-21T11:25:47.403919+00:00",
        "updated_at": "2022-07-21T11:25:48.278649+00:00",
        "status": "Created",
        "payment_status": "Hold",
        "delivery_status": "Init",
        "delivery_address": "Россия, Ленинградская обл., с. Северо-Курильск, ш. Лазурное, д. 272 стр. 4, 344000",
        "antifraud_status": "Passed",
        "buyer_country_code": "Россия",
        "buyer_name": "Рогова Галина Владиславовна",
        "order_display_status": "WaitSendGoods",
        "buyer_phone": "+79158589525",
        "order_lines": [
          {
            "id": 2207216760272635,
            "item_id": "1005004380425710",
            "sku_id": "12000028976155229",
            "name": "other",
            "img_url": "https://ae04.alicdn.com/kf/A72bcf633134746b9974336c98bcf1df2L.png_50x50.png",
            "item_price": 0,
            "quantity": 3,
            "total_amount": 0,
            "properties": [
              "other",
              "EC (производитель)",
              "100000015",
              "sell_by_piece",
              "1",
              "10.000",
              "10",
              "23",
              "15"
            ],
            "buyer_comment": "Oms test order creation",
            "height": 2.3,
            "weight": 1.5,
            "width": 10000,
            "length": 1,
            "issue_status": "NoDispute",
            "promotions": null
          }
        ],
        "total_amount": 2,
        "seller_comment": null,
        "fully_prepared": true,
        "finish_reason": null,
        "cut_off_date": "2022-07-22T11:25:37+00:00",
        "cut_off_date_histories": [
          {
            "shift_number": 0,
            "cut_off_date": "2022-07-22T11:25:37+00:00"
          }
        ],
        "shipping_deadline": "2022-08-17T13:00:00+07:00",
        "next_cut_off_date": "2022-08-03T13:00:00+07:00",
        "pre_split_postings": [
          {
            "id": 2207213844146108,
            "delivery_fee": 0,
            "first_mile_type": "Dropoff",
            "posting_lines": [
              {
                "id": 2998858,
                "order_line_id": 2207211225867893,
                "item_id": "1005004074623016",
                "sku_id": "12000027954888462",
                "quantity": 2,
                "height": 3,
                "weight": 2,
                "width": 1500,
                "length": 1,
                "name": "other",
                "img_url": "https://ae04.alicdn.com/kf/H6c5517a8538247538838e9fc679738afR.jpg_50x50.jpg",
                "item_price": 0,
                "properties": [
                  "other",
                  "Стекло",
                  "> 12 Лет",
                  "Аргентина",
                  "100000003",
                  "sell_by_piece",
                  "1",
                  "1.500",
                  "10",
                  "30",
                  "20"
                ],
                "buyer_comment": "Oms test order creation"
              }
            ]
          }
        ],
        "logistic_orders": [
          {
            "id": 1113758,
            "trade_order_id": 2207214066364364,
            "track_number": "80099374337016",
            "status": "AwaitingHandoverList",
            "creation_error": {
              "code": null,
              "description": null
            },
            "lines": [
              {
                "sku_id": 12000027954888462,
                "quantity": 2
              }
            ]
          }
        ],
        "commission": {
          "platform_fee": 10,
          "affiliate_fee": 100,
          "estimate_revenue": 100
        }
      }
    ]
  },
  "error": null
}
EOF;
    }
}
