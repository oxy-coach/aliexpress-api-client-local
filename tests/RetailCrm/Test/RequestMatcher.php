<?php
/**
 * PHP version 7.4
 *
 * @category RequestMatcher
 * @package  Simla\Test
 */

namespace RetailCrm\Test;

use Http\Message\RequestMatcher as RequestMatcherInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class RequestMatcher
 *
 * @category RequestMatcher
 * @package  Simla\Test
 */
class RequestMatcher implements RequestMatcherInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    private $optionalHeaders = [];

    /**
     * RequestMatcher constructor.
     *
     * @param string $host
     */
    private function __construct(string $host)
    {
        $this->host = $host;
    }

    /**
     * @param string $host
     *
     * @return \Simla\Test\RequestMatcher
     */
    public static function createMatcher(string $host): RequestMatcher
    {
        return new self($host);
    }

    /**
     * @param string $path
     *
     * @return RequestMatcher
     */
    public function setPath(string $path): RequestMatcher
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $scheme
     *
     * @return RequestMatcher
     */
    public function setScheme(string $scheme): RequestMatcher
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @param array $headers
     *
     * @return RequestMatcher
     */
    public function setHeaders(array $headers): RequestMatcher
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function matches(RequestInterface $request)
    {
        if ($this->scheme && strtoupper($request->getUri()->getScheme()) !== strtoupper($this->scheme)) {
            return false;
        }

        if (null !== $this->path && !preg_match('{'.$this->path.'}', rawurldecode($request->getUri()->getPath()))) {
            return false;
        }

        if (null !== $this->host && $this->host !== $request->getUri()->getHost()) {
            return false;
        }

        if (!empty($this->headers) && count(array_diff_assoc($this->headers, $request->getHeaders())) > 0) {
            return false;
        }

        if (!empty($this->optionalHeaders)
            && !$this->firstArrayPresentInSecond($this->optionalHeaders, $request->getHeaders())
        ) {
            return false;
        }

        return true;
    }

    /**
     * @param array $first
     * @param array $second
     *
     * @return bool
     */
    private function firstArrayPresentInSecond(array $first, array $second): bool
    {
        return count(array_diff_assoc($first, array_intersect_assoc($first, $second))) === 0;
    }
}
