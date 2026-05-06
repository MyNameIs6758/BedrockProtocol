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

class ServerStoreInfoPacket extends DataPacket implements ClientboundPacket {

	public const NETWORK_ID = ProtocolInfo::SERVER_STORE_INFO_PACKET;

	private string $storeId;
	private string $storeName;

	/**
	 * @generate-create-func
	 */
	public static function create(string $storeId, string $storeName) : self {
		$result = new self;
		$result->storeId = $storeId;
		$result->storeName = $storeName;
		return $result;
	}

	protected function decodePayload(ByteBufferReader $in) : void{
		$this->storeId = CommonTypes::getString($in);
		$this->storeName = CommonTypes::getString($in);
	}

	protected function encodePayload(ByteBufferWriter $out) : void{
		CommonTypes::putString($out, $this->storeId);
		CommonTypes::putString($out, $this->storeName);
	}

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handleServerStoreInfoPacket($this);
	}


}
