<?php

// TODO: these constants should be replaced with OpenTracing constants as soon
// as a OpenTracing PHP library exists.
define("LIGHTSTEP_FORMAT_TEXT_MAP", "LIGHTSTEP_FORMAT_TEXT_MAP");
define("LIGHTSTEP_FORMAT_BINARY", "LIGHTSTEP_FORMAT_BINARY");

/**
 *@internal
 *
 * The trace join ID key used for identifying the end user.
 */
define("LIGHTSTEP_JOIN_KEY_END_USER_ID", "end_user_id");
