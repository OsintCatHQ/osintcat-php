<?php

namespace OsintCat\Vin\Types;

enum QueryVinRequestType: string
{
    case Decode = "decode";
    case Batch = "batch";
    case Wmi = "wmi";
    case Makes = "makes";
    case Manufacturers = "manufacturers";
    case Variables = "variables";
    case Canadian = "canadian";
}
