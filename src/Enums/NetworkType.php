<?php

namespace MoveMoveApp\Maxmind\Enums;

enum NetworkType: string
{
    case INVALID = 'invalid';
    case IPV4 = 'IPV4';
    case IPV6 = 'IPV6';
}
