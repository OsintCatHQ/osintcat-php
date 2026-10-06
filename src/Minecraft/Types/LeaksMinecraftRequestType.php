<?php

namespace OsintCat\Minecraft\Types;

enum LeaksMinecraftRequestType: string
{
    case Username = "username";
    case Uuid = "uuid";
    case Email = "email";
    case Ip = "ip";
    case Password = "password";
}
