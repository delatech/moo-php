<?php
namespace MooPhp\Serialization;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

interface Marshaller {

	public function marshall($object, $ref);

	public function unmarshall($data, $ref);

}
