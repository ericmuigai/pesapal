<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 6/13/14
 * Time: 2:04 AM
 */

namespace Ericmuigai\Pesapal;


class OAuthSignatureMethod {
    public function check_signature(&$request, $consumer, $token, $signature) {
        $built = $this->build_signature($request, $consumer, $token);
        return $built == $signature;
    }
}