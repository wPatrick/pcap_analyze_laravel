<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Organization[] $organizations
 * @property-read int|null $organizations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property int $account_id
 * @property int|null $organization_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $region
 * @property string|null $country
 * @property string|null $postal_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $name
 * @property-read \App\Models\Organization|null $organization
 * @method static \Database\Factories\ContactFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Query\Builder|Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact orderByName()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Contact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contact withoutTrashed()
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Customer
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $short_name
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $street
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $description
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Customer filter($name)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Device
 *
 * @property int $id
 * @property int $device_meta_id
 * @property int $number
 * @property string $serial
 * @property string $mac
 * @property DeviceMeta $device_meta
 * @property Collection|Process[] $processes
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Process[] $process
 * @property-read int|null $process_count
 * @method static \Illuminate\Database\Eloquent\Builder|Device filter($name)
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeviceMetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereMac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSerial($value)
 */
	class Device extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DeviceIp
 *
 * @property int $id
 * @property int $device_id
 * @property string $ip
 * @property ProcessDevice $process_device
 * @package App\Models
 * @property int $process_device_ip
 * @property-read \App\Models\ProcessDevice|null $device
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceIp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceIp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceIp query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceIp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceIp whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceIp whereProcessDeviceIp($value)
 */
	class DeviceIp extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DeviceMeta
 *
 * @property int $id
 * @property int $manufacturer_id
 * @property int $device_type_id
 * @property string $name
 * @property int $obl_id
 * @property int $quantity
 * @property Carbon|null $date_of_receipt
 * @property Carbon|null $date_of_issue
 * @property string|null $typ
 * @property string|null $misc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property DeviceType $device_type
 * @property Manufacturer $manufacturer
 * @property Collection|Device[] $devices
 * @package App\Models
 * @property-read int|null $devices_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereDateOfIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereDateOfReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereDeviceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereMisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereOblId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceMeta whereUpdatedAt($value)
 */
	class DeviceMeta extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DeviceType
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Device[] $devices
 * @package App\Models
 * @property-read int|null $devices_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType filter($name)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereUpdatedAt($value)
 */
	class DeviceType extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Dn
 *
 * @property int $id
 * @property int $udp_id
 * @property string $name
 * @property Udp $udp
 * @property Collection|DnsAddress[] $dns_addresses
 * @package App\Models
 * @property-read int|null $dns_addresses_count
 * @method static \Illuminate\Database\Eloquent\Builder|Dns newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dns newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dns query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dns whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dns whereUdpId($value)
 */
	class Dns extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DnsAddress
 *
 * @property int $id
 * @property int $dns_id
 * @property string $ip
 * @property Dns $dn
 * @package App\Models
 * @property-read \App\Models\Dns $dns
 * @method static \Illuminate\Database\Eloquent\Builder|DnsAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DnsAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DnsAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|DnsAddress whereDnsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DnsAddress whereIp($value)
 */
	class DnsAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Http
 *
 * @property int $id
 * @property int $tcp_id
 * @property string $url
 * @property Tcp $tcp
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Http newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Http newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Http query()
 * @method static \Illuminate\Database\Eloquent\Builder|Http whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Http whereTcpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Http whereUrl($value)
 */
	class Http extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property string $uuid
 * @property int|null $manufacturer_id
 * @property string|null $typ
 * @property string|null $seriennummer
 * @property string|null $geraet
 * @property string|null $eigenschaften
 * @property int|null $emv
 * @property int|null $safety
 * @property int|null $tco
 * @property int|null $ergonomy
 * @property int|null $umwelt
 * @property int|null $qualitaet
 * @property int|null $akkustik
 * @property int|null $emv_pruef
 * @property int|null $safety_pruef
 * @property int|null $tco_pruef
 * @property int|null $ergonomy_pruef
 * @property int|null $umwelt_pruef
 * @property int|null $qualitaet_pruef
 * @property int|null $akkustik_pruef
 * @property string|null $emv_berichtsnummer
 * @property string|null $safety_berichtsnummer
 * @property string|null $tco_berichtsnummer
 * @property string|null $ergonomy_berichtsnummer
 * @property string|null $umwelt_berichtsnummer
 * @property string|null $qualitaet_berichtsnummer
 * @property string|null $akkustik_berichtsnummer
 * @property string|null $rechnunsgsnummer
 * @property string|null $rechnungsdatum
 * @property string|null $rechnunsbetrag
 * @property string|null $wareneingangsdatum
 * @property string|null $angenommen_von
 * @property string|null $spediteur
 * @property string|null $warenausgangsdatum
 * @property string|null $lieferscheinnummer_ausgang
 * @property string|null $lieferscheinnummer_eingang
 * @property string|null $auftragsnummer_kunde
 * @property string|null $emv_ausstellungsdatum
 * @property string|null $safety_ausstellungsdatum
 * @property string|null $tco_ausstellungsdatum
 * @property string|null $ergonomy_ausstellungsdatum
 * @property string|null $umwelt_ausstellungsdatum
 * @property string|null $qualitaet_ausstellungsdatum
 * @property string|null $akkustik_ausstellungsdatum
 * @property string|null $art_bericht
 * @property string|null $art_pruef
 * @property string|null $bericht
 * @property string|null $pruef_ergebnis
 * @property string|null $angebot
 * @property string|null $angebotsbestaetigung
 * @property string|null $rechnung
 * @property string|null $notizen
 * @property string|null $obl_nummer_intern
 * @property int|null $eigenbedarf
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $auftragsbestaetigung
 * @property-read \App\Models\Manufacturer|null $manufacturer
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Query\Builder|Inventory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAkkustik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAkkustikAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAkkustikBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAkkustikPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAngebot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAngebotsbestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAngenommenVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereArtBericht($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereArtPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAuftragsbestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereAuftragsnummerKunde($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereBericht($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereEigenbedarf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereEigenschaften($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereEmv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereEmvAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereEmvBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereEmvPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereErgonomy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereErgonomyAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereErgonomyBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereErgonomyPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereGeraet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereLieferscheinnummerAusgang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereLieferscheinnummerEingang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereNotizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereOblNummerIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory wherePruefErgebnis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereQualitaet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereQualitaetAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereQualitaetBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereQualitaetPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereRechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereRechnungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereRechnunsbetrag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereRechnunsgsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSafety($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSafetyAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSafetyBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSafetyPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSeriennummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereSpediteur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereTco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereTcoAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereTcoBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereTcoPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUmwelt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUmweltAusstellungsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUmweltBerichtsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUmweltPruef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereWarenausgangsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereWareneingangsdatum($value)
 * @method static \Illuminate\Database\Query\Builder|Inventory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Inventory withoutTrashed()
 */
	class Inventory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Ip
 *
 * @property int $id
 * @property int $pcap_id
 * @property int $process_id
 * @property string $mac_src
 * @property string $mac_dst
 * @property string $ip_src
 * @property string $ip_dst
 * @property bool $is_locale
 * @property bool $is_eu
 * @property string|null $city
 * @property string|null $country
 * @property string|null $asn
 * @property string|null $aso
 * @property Pcap $pcap
 * @property Process $process
 * @property Collection|Tcp[] $tcps
 * @property Collection|Udp[] $udps
 * @package App\Models
 * @property int $ip_src_is_locale
 * @property int $ip_dst_is_locale
 * @property-read string $pcap_name
 * @property-read int|null $tcps_count
 * @property-read int|null $udps_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereAsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereAso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereIpDst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereIpDstIsLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereIpSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereIpSrcIsLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereIsEu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip wherePcapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ip whereProcessId($value)
 */
	class Ip extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer filter($name)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereUuid($value)
 */
	class Manufacturer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Organization
 *
 * @property int $id
 * @property int $account_id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $region
 * @property string|null $country
 * @property string|null $postal_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @method static \Database\Factories\OrganizationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Query\Builder|Organization onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Organization withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Organization withoutTrashed()
 */
	class Organization extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Pcap
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property int $process_id
 * @property bool|null $analyzed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Process $process
 * @property Collection|Ip[] $ips
 * @package App\Models
 * @property-read int|null $ips_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap whereAnalyzed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap whereProcessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pcap whereUpdatedAt($value)
 */
	class Pcap extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Process
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $obl_id
 * @property string $stage
 * @property string $stage_text
 * @property Collection|Ip[] $ips
 * @property Collection|Pcap[] $pcaps
 * @property Collection|ProcessDeviceComparison[] $process_device_comparisons
 * @property Collection|Device[] $devices
 * @property Collection|ProcessSetting[] $process_settings
 * @package App\Models
 * @property-read int|null $devices_count
 * @property-read int|null $ips_count
 * @property-read int|null $pcaps_count
 * @property-read int|null $process_device_comparisons_count
 * @property-read int|null $process_settings_count
 * @method static \Illuminate\Database\Eloquent\Builder|Process newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Process newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Process query()
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereOblId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereStageText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Process whereUpdatedAt($value)
 */
	class Process extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProcessDevice
 *
 * @property int $id
 * @property int $process_id
 * @property string $name
 * @property string|null $mac
 * @property string $ip_address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Process $process
 * @property Collection|DeviceIp[] $device_ips
 * @package App\Models
 * @property int $device_id
 * @property string $obl_ext
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeviceIp[] $ips
 * @property-read int|null $ips_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice whereOblExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDevice whereProcessId($value)
 */
	class ProcessDevice extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProcessDeviceComparison
 *
 * @property int $id
 * @property int $process_device_a_id
 * @property int $process_device_b_id
 * @property Process $process
 * @package App\Models
 * @property-read \App\Models\Process $device_a
 * @property-read \App\Models\Process $device_b
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDeviceComparison newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDeviceComparison newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDeviceComparison query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDeviceComparison whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDeviceComparison whereProcessDeviceAId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessDeviceComparison whereProcessDeviceBId($value)
 */
	class ProcessDeviceComparison extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProcessSetting
 *
 * @property int $id
 * @property int $p_id
 * @property string $name
 * @property string $value
 * @property Process $process
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting wherePId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcessSetting whereValue($value)
 */
	class ProcessSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Tcp
 *
 * @property int $id
 * @property int $ip_id
 * @property string $port_src
 * @property string $port_dst
 * @property Ip $ip
 * @property Collection|Http[] $https
 * @property Collection|Tls[] $tls
 * @package App\Models
 * @property-read int|null $https_count
 * @property-read int|null $tls_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp whereIpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp wherePortDst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tcp wherePortSrc($value)
 */
	class Tcp extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Tl
 *
 * @property int $id
 * @property int $tcp_id
 * @property string $sni
 * @property Tcp $tcp
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Tls newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tls newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tls query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tls whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tls whereSni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tls whereTcpId($value)
 */
	class Tls extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Udp
 *
 * @property int $id
 * @property int $ip_id
 * @property string $port_src
 * @property string $port_dst
 * @property Ip $ip
 * @property Collection|Dns[] $dns
 * @package App\Models
 * @property-read int|null $dns_count
 * @method static \Illuminate\Database\Eloquent\Builder|Udp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Udp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Udp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Udp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Udp whereIpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Udp wherePortDst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Udp wherePortSrc($value)
 */
	class Udp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $account_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property bool $owner
 * @property string|null $photo_path
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Account|null $account
 * @property-read mixed $name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User orderByName()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($role)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

