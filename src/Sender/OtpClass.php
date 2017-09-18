<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for build and send OTP
 *
 * @package    Sender\OtpClass
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class OtpClass
{
    /**
     * @var array $inputData
     */
    protected $inputData = null;
    /**
     * @var array $sendData
     */
    protected $sendData = null;
    /**
     * @var string $message
     */
    protected $message = null;
    /**
     * @var string $sender
     */
    protected $sender = null;
    /**
     * @var int $otp
     */
    protected $otp = null;
    /**
     * @var int $otpExpiry
     */
    protected $otpExpiry = null;
    /**
     * @var int $otpLength
     */
    protected $otpLength = null;
    /**
     * @var string $authkey
     */
    protected $authkey = null;
    /**
     * @var int $mobile
     */
    protected $mobile = null;
    /**
     * @var string $retrytype
     */
    protected $retrytype = null;
    /**
     * Check the data empty
     * @return bool
     */
    public function hasInputData()
    {
        return isset($this->inputData);
    }
    /**
     * Check the sendData empty
     * @return bool
     */
    public function hasSendData()
    {
        return isset($this->sendData);
    }
    /**
     * Check key present in array or not
     * @param string $key
     * @param array  $array
     *
     * @return bool
     */
    protected function isKeyExists($key, $array)
    {
        return array_key_exists($key, $array);
    }
    /**
     * set message
     * @return bool
     */
    public function setMessage()
    {
        $this->message = $this->inputData['message'];
        return true;
    }
    /*
     * get message
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * set sender
     * @return bool
     */
    public function setSender()
    {
        $this->sender = $this->inputData['sender'];
        return true;
    }
    /*
     * get sender
     */
    public function getSender()
    {
        return $this->sender;
    }
    /**
     * set otp
     * @return bool
     */
    public function setOtp()
    {
        $this->otp = $this->inputData['otp'];
        return true;
    }
    /*
     * get otp
     */
    public function getOtp()
    {
        return $this->otp;
    }
    /**
     * set otp
     * @return bool
     */
    public function setOneTimePass()
    {
        $this->otp = $this->sendData['otp'];
        return true;
    }
    /*
     * get setonetime
     */
    public function getOneTimePass()
    {
        return $this->otp;
    }
    /**
     * set otp_expiry
     * @return bool
     */
    public function setOtpExpiry()
    {
        $this->otpExpiry = $this->inputData['otp_expiry'];
        return true;
    }
    /*
     * get otp_expiry
     */
    public function getOtpExpiry()
    {
        return $this->otpExpiry;
    }
    /**
     * set otp_length
     * @return bool
     */
    public function setOtpLength()
    {
        $this->otpLength = $this->inputData['otp_length'];
        return true;
    }
    /*
     * get otp_length
     */
    public function getOtpLength()
    {
        return $this->otpLength;
    }
    /**
     * set authkey
     * @return bool
     */
    public function setAuthkey()
    {
        $this->authkey = $this->sendData['authkey'];
        return true;
    }
    /*
     * get authkey
     */
    public function getAuthkey()
    {
        return $this->authkey;
    }
    /**
     * set mobile
     * @return bool
     */
    public function setmobile()
    {
        $this->mobile = $this->sendData['mobile'];
        return true;
    }
    /*
     * get mobile
     */
    public function getmobile()
    {
        return $this->mobile;
    }
    /**
     * set retrytype
     * @return bool
     */
    public function setRetryType()
    {
        $this->retrytype = $this->sendData['retrytype'];
        return true;
    }
    /*
     * get retrytype
     */
    public function getRetryType()
    {
        return $this->retrytype;
    }
    /**
     * Check integer value
     * @return bool
     */
    public function isInterger($value)
    {
        $result = Validation::isInteger($value);
        return $result;
    }
    /**
     * Check string value
     * @param string $value
     * @return bool
     */
    public function isString($value)
    {
        $result = Validation::isString($value);
        return $result;
    }
    /**
     * Add otp on the array
     * @param   array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    public function addMessage($data)
    {
        if ($this->isKeyExists('message', $this->inputData) && $this->setMessage()) {
            if ($this->isString($this->getMessage())) {
                $data['message'] = $this->getMessage() ? $this->getMessage() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("message", "string", $this->getMessage());
            }
        }
        return $data;
    }
    /**
     * Add sender on the Array
     * @param   array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    public function addSender($data)
    {
        if ($this->isKeyExists('sender', $this->inputData) && $this->setSender()) {
            if ($this->isString($this->getSender())) {
                if (strlen($this->getSender()) == 6) {
                    $data['sender'] = $this->getSender() ? $this->getSender() : null;
                } else {
                    $message = "String length must be 6 characters";
                    throw ParameterException::invalidInput("sender", "string", $this->getSender(), $message);
                }
            } else {
                throw ParameterException::invalidArrtibuteType("sender", "string", $this->getSender());
            }
        }
        return $data;
    }
    /**
     * Add otp on the array
     * @param   array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    public function addOtp($data)
    {
        if ($this->isKeyExists('otp', $this->inputData) && $this->setOtp()) {
            if ($this->isInterger($this->getOtp())) {
                $data['otp'] = $this->getOtp() ? $this->getOtp() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("otp", "int", $this->getOtp());
            }
        }
        return $data;
    }
    /**
     * Add otp_expiry on the array
     * @param  array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    public function addOtpExpiry($data)
    {
        if ($this->isKeyExists('otp_expiry', $this->inputData) && $this->setOtpExpiry()) {
            if ($this->isInterger($this->getOtpExpiry())) {
                $data['otp_expiry'] = $this->getOtpExpiry() ? $this->getOtpExpiry() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("otp_expiry", "int", $this->getOtpExpiry());
            }
        }
        return $data;
    }
    /**
     * Add otp_length on the array
     * @param   array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    public function addOtpLength($data)
    {
        if ($this->isKeyExists('otp_length', $this->inputData) && $this->setOtpLength()) {
            if ($this->isInterger($this->getOtpLength())) {
                $value  = array('options' => array('min_range' => 4, 'max_range' => 9));
                $result = filter_var($this->getOtpLength(), FILTER_VALIDATE_INT, $value);
                $data["otp_length"] = $result ? $result : null;
            } else {
                $message = "otp_length between 4 to 6 integer";
                throw ParameterException::invalidInput("otp_length", "int", $this->getOtpLength(), $message);
            }
        }
        return $data;
    }
    /**
     * Check Authkey
     *
     * @throws ParameterException missing parameters or return empty
     * @return bool
     */
    public function checkAuthKey()
    {
        if ($this->isKeyExists('authkey', $this->sendData) && $this->setAuthkey()) {
            if ($this->isString($this->getAuthkey())) {
                return true;
            } else {
                throw ParameterException::invalidArrtibuteType("Authkey", "string", $this->getAuthkey());
            }
        } else {
            $message = "Parameter Authkey missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * Check mobile
     *
     * @throws ParameterException missing parameters or return empty
     * @return bool
     */
    public function checkMobile()
    {
        if ($this->isKeyExists('mobile', $this->sendData) && $this->setmobile()) {
            if ($this->isInterger($this->getmobile())) {
                return true;
            } else {
                throw ParameterException::invalidArrtibuteType("mobile", "int", $this->getmobile());
            }
        } else {
            $message = "Parameter mobile missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * This function for send OTP
     *
     * @param array $dataArray
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return string Msg91 Json response
     */
    public function sendOtp($dataArray, $data)
    {
        $this->inputData    = $dataArray;
        $this->sendData     = $data;
        if ($this->hasInputData() && $this->hasSendData()) {
            if ($this->checkAuthKey() && $this->checkMobile()) {
                $data = $this->sendData;
                //add sender on the Array
                $data = $this->addSender($data);
                //add otp_expiry on the array
                $data = $this->addOtpExpiry($data);
                //add otp_length on the array
                $data = $this->addOtpLength($data);
                $checkOtp = array_key_exists('otp', $this->inputData);
                $checkMsg = array_key_exists('message', $this->inputData);
                if ($checkOtp && $checkMsg) {
                    //add message on array
                    $data = $this->addMessage($data);
                    //add otp on the array
                    $data = $this->addOtp($data);
                }
                if (($checkOtp && !$checkMsg) || (!$checkOtp && $checkMsg)) {
                    throw ParameterException::missinglogic("When using otp or message, unable to use seperately");
                }
            }
            $uri = "sendotp.php";
            $delivery = new Deliver();
            $response = $delivery->sendOtpGet($uri, $data);
            return $response;
        } else {
            $message = "The wrong parameter found";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * Add retry type
     *
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array Msg91 Json response
     */
    public function addRetryType($data)
    {
        if ($this->isKeyExists('retrytype', $this->sendData) && $this->setRetryType()) {
            if ($this->isString($this->getRetryType())) {
                $data['retrytype'] = $this->getRetryType() ? $this->getRetryType() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("retrytype", "string", $this->getRetryType());
            }
        }
        return $data;
    }
    /**
     * Add otp on the array
     * @param   array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    public function addOneTimePass($data)
    {
        if ($this->isKeyExists('otp', $this->sendData) && $this->setOneTimePass()) {
            if ($this->isInterger($this->getOneTimePass())) {
                $data['otp'] = $this->getOneTimePass() ? $this->getOneTimePass() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("otp", "int", $this->getOneTimePass());
            }
        }
        return $data;
    }
    /**
     * This function for retry and verify OTP
     * @param int    $category
     * @param array  $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return string Msg91 Json response
     */
    public function resendVerifyOtp($data, $category)
    {
        $this->sendData     = $data;
        if ($this->hasSendData()) {
            if ($this->checkAuthKey() && $this->checkMobile()) {
                $data = $this->sendData;
                //add retry type on array
                $data = $this->addRetryType($data);
                //add otp on array
                $data = $this->addOneTimePass($data);
            }
        } else {
            $message = "The parameters not found";
            throw ParameterException::missinglogic($message);
        }
        if ($category === 0) {
            $uri = 'retryotp.php';
        } else {
            $uri = "verifyRequestOTP.php";
        }
        $delivery = new Deliver();
        $response = $delivery->sendOtpGet($uri, $data);
        return $response;
    }
}
