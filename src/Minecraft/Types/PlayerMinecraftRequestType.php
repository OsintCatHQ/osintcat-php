<?php

namespace OsintCat\Minecraft\Types;

enum PlayerMinecraftRequestType: string
{
    case Username = "username";
    case Uuid = "uuid";
    case Email = "email";
    case Ip = "ip";
}
