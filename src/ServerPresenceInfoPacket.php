<?php
/*
 * This file is part of BedrockProtocol.
 * Copyright (C) 2014-2022 PocketMine Team <https://github.com/pmmp/BedrockProtocol>
 *
 * BedrockProtocol is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol;

use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

class ServerPresenceInfoPacket extends DataPacket implements ClientboundPacket {

	public const NETWORK_ID = ProtocolInfo::SERVER_PRESENCE_INFO_PACKET;

	private string $experienceName;

	private string $wordlName;

	/**
	 * @generate-create-func
	 */
	public static function create(string $experienceName, string $wordlName) : self{
		$result = new self();
		$result->experienceName = $experienceName;
		$result->wordlName = $wordlName;
		return $result;
	}

	protected function decodePayload(ByteBufferReader $in) : void{
		$this->experienceName = CommonTypes::getString($in);
		$this->wordlName = CommonTypes::getString($in);
	}

	protected function encodePayload(ByteBufferWriter $out) : void{
		CommonTypes::putString($out, $this->experienceName);
		CommonTypes::putString($out, $this->wordlName);
	}

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handleServerPresenceInfo($this);
	}


}
