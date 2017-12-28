<?php

class Address{
    private $id;
    private $firstName;
    private $lastName;
    private $country;
    private $city;
    private $county;
    private $district;
    private $billingAddress;
    private $cargoAddress;
    private $postCode;
    private $addressName;
    private $phoneNumber;

    /**
     * Address constructor.
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $country
     * @param $city
     * @param $county
     * @param $district
     * @param $billingAddress
     * @param $cargoAddress
     * @param $postCode
     * @param $addressName
     * @param $phoneNumber
     */
    public function __construct($firstName, $lastName, $country, $city, $county, $district, $billingAddress, $cargoAddress, $postCode, $addressName, $phoneNumber)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->country = $country;
        $this->city = $city;
        $this->county = $county;
        $this->district = $district;
        $this->billingAddress = $billingAddress;
        $this->cargoAddress = $cargoAddress;
        $this->postCode = $postCode;
        $this->addressName = $addressName;
        $this->phoneNumber = $phoneNumber;
    }


    /**
     * @return mixed
     */
    public function getİd()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setİd($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param mixed $county
     */
    public function setCounty($county)
    {
        $this->county = $county;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return mixed
     */
    public function getCargoAddress()
    {
        return $this->cargoAddress;
    }

    /**
     * @param mixed $cargoAddress
     */
    public function setCargoAddress($cargoAddress)
    {
        $this->cargoAddress = $cargoAddress;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }

    /**
     * @return mixed
     */
    public function getAddressName()
    {
        return $this->addressName;
    }

    /**
     * @param mixed $addressName
     */
    public function setAddressName($addressName)
    {
        $this->addressName = $addressName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }




}