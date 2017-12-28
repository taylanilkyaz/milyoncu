<?php
require_once '../iyzico-b4u/config.php';

class CardStore{

    /**
     * @param $conserveationId Sipariş id'si
     * @param $email
     * @param $externalId Kartın veritabanındaki id'si.
     * @param $cardAlias
     * @param $cardHolderName
     * @param $cardNumber
     * @param $cardExpireMonth
     * @param $cardExpireYear
     */
    public function create_user_and_add_card($email, $externalId,
                                             $cardAlias, $cardHolderName,
                                             $cardNumber, $cardExpireMonth,
                                             $cardExpireYear){
        # create request class
        $request = new \Iyzipay\Request\CreateCardRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        //$request->setConversationId($conserveationId);
        $request->setEmail($email);
        $request->setExternalId($externalId);

        $cardInformation = new \Iyzipay\Model\CardInformation();
        $cardInformation->setCardAlias($cardAlias);
        $cardInformation->setCardHolderName($cardHolderName);
        $cardInformation->setCardNumber($cardNumber);
        $cardInformation->setExpireMonth($cardExpireMonth);
        $cardInformation->setExpireYear($cardExpireYear);

        $request->setCard($cardInformation);

        # make request
        $card = \Iyzipay\Model\Card::create($request, Config::options());

        var_dump($card);
        return $card;
    }

    public function create_card($conversationId,$cardUserKey,
                                $cardAlias,$cardHolderName,
                                $cardNumber,$cardExpireMonth,
                                $cardExpireYear)
    {
        # create request class
        $request = new \Iyzipay\Request\CreateCardRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId($conversationId);
        $request->setCardUserKey($cardUserKey);

        $cardInformation = new \Iyzipay\Model\CardInformation();
        $cardInformation->setCardAlias("paraf");
        $cardInformation->setCardHolderName($cardHolderName);
        $cardInformation->setCardNumber($cardNumber);
        $cardInformation->setExpireMonth($cardExpireMonth);
        $cardInformation->setExpireYear($cardExpireYear);

        $request->setCard($cardInformation);
        # make request
        $card = \Iyzipay\Model\Card::create($request, Config::options());
        # print result

        vard_dump($card);
    }

    public function list_card($cardUserKey):\Iyzipay\Model\CardList{
        $request = new \Iyzipay\Request\RetrieveCardListRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setCardUserKey($cardUserKey);

        $cardList = \Iyzipay\Model\CardList::retrieve($request, Config::options());


        //var_dump($cardList);
        return $cardList;
    }

    public function delete_card($cardToken,$cardUserKey){
        $request = new \Iyzipay\Request\DeleteCardRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setCardToken($cardToken);
        $request->setCardUserKey($cardUserKey);

        $card = \Iyzipay\Model\Card::delete($request, Config::options());

        //var_dump($card);
    }

    
}