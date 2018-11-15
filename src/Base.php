<?php
/*
 * CoinMarketCap API implementation of https://coinmarketcap.com/api/.
 *
 * Branched from https://github.com/tregismoreira/coinmarketcap-php
 *
 */
 

namespace CoinMarketCap;

class Base
{
    /**
     * @var string
     */
    const BASE_URL = 'https://api.coinmarketcap.com/v2/';

    /**
     * @param array $params
     * @return array
     */
    public function getTicker($params = array())
    {
        return $this->buildRequest('ticker/', $params);
    }
	
	/**
     * @param $coinSlug
     * @return INT
     */
    public function getTickerIdByCoinName( $coinSlug ) 
    {
        $tickers = $this->buildRequest('listings/', $params);
		
		//Loop through and find the ticker ID..ugh.
		$id = 0;
		foreach ($tickers['data'] as $ticker) {
			if ( $ticker['website_slug'] == $coinSlug ) {
				$id = $ticker['id'];
				break;
			}
		}
		
		return $id;
	}
	
    /**
     * @param $coinId
     * @param array $params
     * @return array
     */
    public function getTickerByCoin($coinId, $params = array())
    {
		if ( !is_numeric($coinId) ) {
			$coinId = self::getTickerIdByCoinName( $coinId );
		}
		
		$ticker_data = $this->buildRequest('ticker/' . $coinId . "/", $params);
		
		return $ticker_data['data'];
    }

    /**
     * @param array $params
     * @return array
     */
    public function getGlobalData($params = array())
    {
        return $this->buildRequest('global/', $params);
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return array
     */
    private function buildRequest($endpoint, $params = array())
    {
		$ch = curl_init();
		$url = $this->buildUrl(self::BASE_URL . $endpoint, $params);
		
		//Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		
		// Closing
		curl_close($ch);
        return json_decode($result, true);		
    }

    /**
     * @param $url
     * @param array $params
     * @return string
     */
    private function buildUrl($url, $params = array())
    {
        $output = $url;

        if ($params) {
          $output .= '?' . http_build_query($params);
        }
		
        return $output;
    }

	
}