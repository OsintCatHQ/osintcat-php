<?php

namespace OsintCat\Breach\Types;

enum DatabaseSearchBreachRequestType: string
{
    case Email = "email";
    case Domain = "domain";
}
