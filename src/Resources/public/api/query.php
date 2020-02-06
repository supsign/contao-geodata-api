<?php

use Supsign\ContaoGeoDataApiBundle\Controller\FrontendModule\GeoDataApi;

if (isset($_GET['search']) ) {

	echo (new GeoDataApi)->getCityOrZipJson($_GET['search']);
}