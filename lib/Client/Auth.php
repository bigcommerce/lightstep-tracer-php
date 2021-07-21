<?php
namespace LightStepBase\Client;

use Lightstep\Collector\Auth as ProtoAuth;

/**
 * Class Auth encapsulates the data required to create an Auth object for RPC.
 * @package LightStepBase\Client
 */
class Auth
{
    protected $_accessToken = "";

    /**
     * Auth constructor.
     * @param string $accessToken Identifier for a project, used to authenticate with LightStep satellites.
     */
    public function __construct($accessToken) {
        $this->_accessToken = $accessToken;
    }

    /**
     * @return string The access token.
     */
    public function getAccessToken() {
        return $this->_accessToken;
    }

    /**
     * @return \CroutonThrift\Auth A Thrift representation of this object.
     */
    public function toThrift() {
        return new \CroutonThrift\Auth([
            'access_token' => strval($this->_accessToken),
        ]);
    }

    /**
     * @return ProtoAuth A Proto representation of this object.
     */
    public function toProto() {
        return new ProtoAuth([
            'access_token' => $this->_accessToken
        ]);
    }
}
