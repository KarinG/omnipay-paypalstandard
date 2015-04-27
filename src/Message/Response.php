<?php

namespace Omnipay\Paypalstandard\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Stripe Response
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
  /**
   * endpoint is the remote url - should be provided by the processor.
   * we are using github as a filler
   *
   * @var string
   */

    public $endpoint = 'https://www.paypal.com/cgi-bin/webscr?business=adc%40lllc.ca&notify_url=http%3A//master.localhost/sites/all/modules/civicrm/extern/ipn.php%3Freset%3D1%26contactID%3D202%26contributionID%3D144%26module%3Dcontribute&item_name=Online+Contribution%3A+Help+Support+CiviCRM%21&quantity=1&undefined_quantity=0&cancel_return=http%3A//master.localhost/civicrm/contribute/transact%3F_qf_Main_display%3D1%26cancel%3D1%26qfKey%3D625fc646d33436867a2bd9ff00a2fa91_5405&no_note=1&no_shipping=1&return=http%3A//master.localhost/civicrm/contribute/transact%3F_qf_ThankYou_display%3D1%26qfKey%3D625fc646d33436867a2bd9ff00a2fa91_5405&rm=2&currency_code=USD&invoice=bda021136b22877a700635194ebeac8c&lc=US&charset=UTF-8&bn=CiviCRM_SP&email=demo%40example.com&cmd=_xclick&amount=1';

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * Has the call to the processor succeeded?
     * When we need to redirect the browser we return false as the transaction is not yet complete
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Should the user's browser be redirected?
     *
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Transparent redirect is the mode whereby a form is presented to the user that POSTs to the payment
     * processor site directly. If this returns true the site will need to provide a form for this
     *
     * @return bool
     */
    public function isTransparentRedirect()
    {
        return false;
    }

    public function getRedirectUrl()
    {
        return $this->endpoint .'?' . http_build_query($this->data);
    }

    /**
     * Should the browser redirect using GET or POST
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
