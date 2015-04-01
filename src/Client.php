<?php

namespace UserScape\HelpSpot;

use InvalidArgumentException;
use UserScape\HelpSpot\Transformer\ErrorsTransformer;

class Client
{
    use Mixin\CloneWithMixin;

    /**
     * @var Transport
     */
    protected $transport;

    /**
     * @var array
     */
    protected $map;

    /**
     * @param Transport  $transport
     * @param null|array $map
     */
    public function __construct(Transport $transport, array $map = null)
    {
        $this->transport = $transport;

        if ($map === null) {
            $map = (array) require __DIR__ . "/map.php";
        }

        $this->map = $map;
    }

    /**
     * @return Transport
     */
    public function transport()
    {
        return $this->transport;
    }

    /**
     * @param Transport $transport
     *
     * @return static
     */
    public function withTransport(Transport $transport)
    {
        return $this->cloneWith("transport", $transport);
    }

    /**
     * @return array
     */
    public function map()
    {
        return $this->map;
    }

    /**
     * @param array $map
     *
     * @return static
     */
    public function withMap(array $map)
    {
        return $this->cloneWith("map", $map);
    }

    /**
     * @param string $endpoint
     * @param array  $parameters
     *
     * @return array|Object
     */
    public function request($endpoint, array $parameters = [])
    {
        $map = $this->mapForEndpoint($endpoint);

        $response = $this->transport->request($map["method"], $endpoint, $parameters);

        if (isset($response["error"])) {
            return $this->transformErrors($response);
        }

        return $this->transformResponse($map["transformer"], $response);
    }

    /**
     * @param string $endpoint
     *
     * @return array
     */
    protected function mapForEndpoint($endpoint)
    {
        if (!isset($this->map[$endpoint])) {
            throw new InvalidArgumentException("Endpoint not mapped");
        }

        $map = $this->map[$endpoint];

        if (!isset($map["method"])) {
            throw new InvalidArgumentException("Endpoint method missing");
        }

        if (!isset($map["transformer"])) {
            throw new InvalidArgumentException("Endpoint transformer missing");
        }

        return $map;
    }

    /**
     * @param array $response
     *
     * @return array|Object
     */
    protected function transformErrors(array $response)
    {
        $transformer = new ErrorsTransformer();

        return $transformer->transform($response);
    }

    /**
     * @param string $transformer
     * @param array  $response
     *
     * @return array|Object
     */
    protected function transformResponse($transformer, array $response)
    {
        /**
         * @var Transformer $transformer
         */
        $transformer = new $transformer();

        return $transformer->transform($response);
    }
}
