<?php
/**
 * JobClass - Geolocalized Job Board Script
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Helpers;

class Geo
{
	/**
	 * getGeoShortName
	 * @param $value
	 * @return string
	 */
    public static function getShortName($value)
    {
    	return $value;

        // Keywords to exclude
        $keywords = [
            'start' => [
                "Sous-R(é|e)gion (des|de la|de l'|de|d'|du)",
                "Sous-R(é|e)gion",
                "Regione Autonoma",
                "Regione (del|di)",
                "Regione",
                "R(é|e)gion (Autonoma|del|des|du|de la|de l'|de|d')",
                "R(é|e)gion",
                "D(é|e)partement (des|du|de la|de l'|de|d')",
                "D(é|e)partement",
                "Freistaat",
                "Land",
                "Provincia Constitucional (del|de)",
                "Provincia (di|del|de|das|da|dos|do)",
                "Provincia",
                "Departamento (del|de)",
                "County (of the|of)",
                "County",
                "Distretto di",
                "District (des|de la|de l'|de|du|d'|of)",
                "District",
                "Province (du|de la|de l'|des|del|de|d'|of the|of)",
                "Province",
                "Provincie",
                "Distrito (del|de|das|da|da|dos|do)",
                "Distrito",
                "Regiao Autonoma dos",
                "Regiao (dos|do)",
                "Regiao",
                "Municipio (del|de|das|da|dos|do)",
                "Municipio",
                "Partido (Primero de|del|de)",
                "Partido",
                "Changwat Phra Nakhon",
                "Changwat",
                "Amphoe Mueang",
                "King Amphoe",
                "Amphoe",
                "Wilaya (des|de la|de l'|de|du|d')",
                "Wilaya",
                "Rrethi i",
                "Qarku i",
                "Parish (of the|of)",
                "Parish",
                "Division (of the|of)",
                "Division",
                "Federal Capital Territory",
                "Laani",
                "Wojewodztwo",
                "Powiat",
                "Oblast",
                "Obshtina",
                "Parroquia (de la|de|d')",
                "Parroquia",
                "Velayat-e",
                "Darwaz-e",
                "Politischer Bezirk",
                "Bezirk",
                "City (of the|of)",
                "State (of the|of)",
                "iProvense ya",
                "Ville de",
                "Commune (des|de la|de l'|de|du|d'|of the|of)",
                "Commune",
                "Sous-Pr(é|e)fecture (des|de la|de l'|de|du|d')",
                "Sous-Pr(é|e)fecture",
                "Pr(é|e)fecture (des|de la|de l'|de|du|d')",
                "Pr(é|e)fecture",
                "Kanton",
                "Cantone",
                "Canton (del|des|de la|de l'|de|du|d')",
                "Canton",
                "Amt",
                "Concelho (del|de|dos|do|das|da)",
                "Concelho",
                "Okres",
                "kraj",
                "Regierungsbezirk",
                "Muhafazat",
                "Markaz (al|ad)",
                "Markaz",
                "Zoba",
                "Comunitat Autonoma (de les Illes|del|de|dos|do)",
                "Comunidad Autonoma",
                "Euskal Autonomia",
                "Capitale d'Etat-Zone Speciale de",
                "Nomos",
                "Arrondissement (des|de la|de l'|de|du|d')",
                "Arrondissement",
                "Kabupaten",
                "Propinsi",
                "Qa(ḑ|d)a'",
                "Mu(ḩ|h)(ā|a)fa(z̧|z)at (al|ad|as)",
                "Mu(ḩ|h)(ā|a)fa(z̧|z)at",
                "Mohafazat",
                "Ostan-e",
                "Shahrestan-e",
                "Khett",
                "Muang",
                "Khoueng",
                "Quarter of",
                "Gemeinde",
                "Balad(ī|i)yat (al|az|ash)",
                "Balad(ī|i)yat",
                "Raionul",
                "Municipiul",
                "Unitate Teritoriala Autonoma",
                "Faritanin' i",
                "Faritanin'",
                "Faritany d'",
                "Estado (del|de|dos|do)",
                "Estado",
                "Daerah",
                "Negeri",
                "Bahagian",
                "Circunscricao (del|de)",
                "Circunscricao",
                "Cidade (del|de)",
                "Cidade",
                "Circonscription (Administrative des|Administrative de la|Administrative de l'|Administrative de|Administrative du|Administrative|de la|de l'|des|de|du|d')",
                "Circonscription",
                "Gemeente",
                "Corregimiento",
                "Municipality of",
                "Municipalit(é|e) (des|de la|de l'|de|d')",
                "Municipalit(é|e)",
                "Federally Administered",
                "Wojewodztwo",
                "Powiat",
                "Judetul",
                "Comuna",
                "Gorod",
                "Mintaqat",
                "Mudiriyat",
                "Al Wilayah",
                "Wilayat",
                "Obshtina",
                "Opshtina",
                "Opstina [historical]",
                "Opstina",
                "Mestna Obcina",
                "Obcina",
                "Okres",
                "Castello di",
                "Gobolka",
                "Distrikt",
                "Mu`tamadiyat",
                "Gouvernorat de la",
                "Gouvernorat de",
                "Delegation de",
                "Ward of",
                "Tỉnh",
                "Huyen",
                "Thanh Pho",
                "Thu Do",
                "Quan",
                "Thi Xa",
                "Komuna e",
                "Komuna",
                "Horad",
            ],
            'end' => [
                "State",
                "Rayonu",
                "District",
                "Dzongkhag",
                "Rayon",
                "Region du",
                "Region",
                "Province",
                "Division",
                "kraj",
                "Kommune",
                "Awraja",
                "Kilil",
                "Laani",
                "sysla",
                "Raioni",
                "Opstina",
                "Zupanija",
                "megye",
                "Area",
                "Aūdany",
                "Oblasty",
                "Oblast'",
                "Oblysy",
                "Qalasy",
                "County",
                "Rajonas",
                "Apskritis",
                "Rajons",
                "Raionul",
                "Municipiul",
                "Aymag",
                "Sum",
                "Atholhu",
                "Zone",
                "Al Mintaqah",
                "Mintaqah",
                "City",
                "Municipality",
                "Capital Territory",
                "Territory",
                "Capital",
                "Agency",
                "Wojewodztwo",
                "Powiat",
                "Administrativnyy Okrug",
                "Kommun",
                "Lan",
                "Welayaty",
                "Ilcesi",
                "Hsien",
                "Shih",
                "Tumani",
                "Viloyati",
                "Shahri",
                "Sǝhǝri",
                "al Muhafazah",
                "Sheng",
                "Zangzu Zizhizhou",
                "Zizhizhou",
                "Zizhiqu",
                "Judetul",
                "Diqu",
                "Shi",
                "(Ā|A)stedader",
            ]
        ];
	
		$keywords['start'] = array_map(function($value) {
			return "#^$value#u";
		}, $keywords['start']);
	
		$keywords['end'] = array_map(function($value) {
			return "#$value$#u";
		}, $keywords['end']);
        
        return trim(preg_replace($keywords['end'], '', preg_replace($keywords['start'], '', $value)));
    }
}
