<?php
namespace App\lib;
class mellat
{
    public function pay($amount)
    {
        $client = new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace='http://interfaces.core.sw.bps.com/';
        $error = $client->getError();
        if($error)
        {
           return false;
        }
        $parameters = array(
            'terminalId' =>$this->get_value('TerminalId'),
            'userName' =>$this->get_value('UserName'),
            'userPassword' =>$this->get_value('Password'),
            'orderId' =>time(),
            'amount' => $amount,
            'localDate' =>date("Ymd"),
            'localTime' =>date("His"),
            'additionalData' =>'خرید',
            'callBackUrl' =>'http://idehpardazanjavan.com/project/shop/order',
            'payerId' =>0
        );

        $result = $client->call('bpPayRequest', $parameters, $namespace);
        $res=@explode(',',$result);
        if(sizeof($res)==2)
        {
            if($res[0]==0)
            {
                return $res[1];
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    public function Verify($SaleOrderId,$SaleReferenceId)
    {
        $client =new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace='http://interfaces.core.sw.bps.com/';
        $error = $client->getError();
        if($error)
        {
            return false;
        }
        $parameters = array
        (
            'terminalId' =>$this->get_value('TerminalId'),
            'userName' =>$this->get_value('UserName'),
            'userPassword' =>$this->get_value('Password'),
            'orderId' => $SaleOrderId,
            'saleOrderId' => $SaleOrderId,
            'saleReferenceId' => $SaleReferenceId
        );
        $VerifyAnswer = $client->call('bpVerifyRequest', $parameters,$namespace);
        if($VerifyAnswer==0)
        {
            $result=$client->call('bpSettleRequest', $parameters,$namespace);
            return true;
        }
        else
        {
            $this->Inquiry($SaleOrderId,$SaleReferenceId);
        }
    }
    public function Inquiry($SaleOrderId,$SaleReferenceId)
    {
        $client =new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace='http://interfaces.core.sw.bps.com/';
        $error = $client->getError();
        if($error)
        {
            return false;
        }
        $parameters = array
        (
            'terminalId' =>$this->get_value('TerminalId'),
            'userName' =>$this->get_value('UserName'),
            'userPassword' =>$this->get_value('Password'),
            'orderId' => $SaleOrderId,
            'saleOrderId' => $SaleOrderId,
            'saleReferenceId' => $SaleReferenceId
        );
        $Inquiry = $client->call('bpInquiryRequest', $parameters,$namespace);
        if($Inquiry==0)
        {
            $result=$client->call('bpSettleRequest', $parameters,$namespace);
            return true;
        }
        else
        {
            $result=$client->call('bpReversalRequest', $parameters,$namespace);
            return false;
        }
    }
    public function get_value($option_name)
    {
        $option_value=\DB::table('setting')->where('option_name',$option_name)->first();
        return $option_value->option_value;
    }
}