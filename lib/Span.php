<?php

namespace LightStepBase;

/**
 * Interface for the handle to an active span.
 */
interface Span {

    // ---------------------------------------------------------------------- //
    // OpenTracing API
    // ---------------------------------------------------------------------- //

    /**
     * Sets the name of the operation that the span represents.
     *
     * @param string $name name of the operation
     */
    public function setOperationName($name);

    /**
     * Finishes the active span. This should always be called at the
     * end of the logical operation that the span represents.
     */
    public function finish();

    /**
     * Returns the instance of the Tracer that created the Span.
     *
     * @return Tracer the instance of the Tracer that created this Span.
     */
    public function tracer();

    /**
     * Sets a tag on the span.  Tags belong to a span instance itself and are
     * not transferred to child or across process boundaries.
     *
     * @param string key the key of the tag
     * @param string value the value of the tag
     */
    public function setTag($key, $value);

    /**
     * Sets a baggage item on the span.  Baggage is transferred to children and
     * across process boundaries; use sparingly.
     *
     * @param string key the key of the baggage item
     * @param string value the value of the baggage item
     */
    public function setBaggageItem($key, $value);

    /**
     * Gets a baggage item on the span.
     *
     * @param string key the key of the baggage item
     */
    public function getBaggageItem($key);

    /**
     * Logs a stably named event along with an optional payload and associates
     * it with the span.
     *
     * @param string event the name used to identify the event
     * @param mixed payload any data to be associated with the event
     */
    public function logEvent($event, $payload = NULL);

    /**
     * Logs a stably named event along with an optional payload and associates
     * it with the span.
     *
     * @param array fields a set of key-value pairs for specifying an event.
     *        'event' string, required the stable name of the event
     *        'payload' mixed, optional any data to associate with the event
     *        'timestamp' float, optional Unix time (in milliseconds)
     *        		representing the event time.
     */
    public function log($fields);

    // ---------------------------------------------------------------------- //
    // LightStep Extentsions
    // ---------------------------------------------------------------------- //

    /**
     * Returns the unique identifier for the span instance.
     *
     * @return string
     */
    public function guid();

    /**
     * Returns the unique identifier for the trace of which this span is a part.
     *
     * @return string
     */
    public function traceGUID();

    /**
     * Sets the GUID of the containing trace onto this span.
     *
     * @param string $traceGUID
     */
    public function setTraceGUID($traceGUID);

    /**
     * Explicitly associates this span as a child operation of the
     * given parent operation. This provides the instrumentation with
     * additional information to construct the trace.
     *
     * @param Span $span the parent span of this span
     */
    public function setParent($span);

    /**
     * Explicitly associates this span as a child operation of the
     * span identified by the given GUID. This provides the
     * instrumentation with additional information to construct the
     * trace.
     * @param string $parentGUID
     */
    public function setParentGUID($parentGUID);

    /**
     * Fetches all baggage for this span.
     *
     * @return array
     */
    public function getBaggage();

    /**
     * Creates a printf-style log statement that will be associated with
     * this particular operation instance.
     *
     * @param string $fmt a format string as accepted by sprintf
     */
    public function infof($fmt);

    /**
     * Creates a printf-style warning log statement that will be associated with
     * this particular operation instance.
     *
     * @param string $fmt a format string as accepted by sprintf
     */
    public function warnf($fmt);

    /**
     * Creates a printf-style error log statement that will be associated with
     * this particular operation instance.
     *
     * @param string $fmt a format string as accepted by sprintf
     */
    public function errorf($fmt);

    /**
     * Creates a printf-style fatal log statement that will be associated with
     * this particular operation instance.
     *
     * If the runtime is enabled, the implementation *will* call die() after
     * creating the log. If the runtime is disabled, the log record will
     * not be created and the die() call will not be made.
     *
     * @param string $fmt a format string as accepted by sprintf
     */
    public function fatalf($fmt);

    /**
     * Provides a mechanism to prevent fatalf from calling die() after
     * creating a log.
     *
     * @param bool $dieOnFatal
     */
    public function setDieOnFatal($dieOnFatal);

    // ---------------------------------------------------------------------- //
    // Deprecated
    // ---------------------------------------------------------------------- //

    /**
     * Sets a string uniquely identifying the user on behalf the
     * span operation is being run. This may be an identifier such
     * as unique username or any other application-specific identifier
     * (as long as it is used consistently for this user).
     *
     *
     *
     * @param string $id a unique identifier of the current user
     */
    public function setEndUserId($id);

    /**
     * Sets a trace join ID key-value pair.
     *
     * @param string $key the trace key
     * @param string $value the value to associate with the given key.
     */
    public function addTraceJoinId($key, $value);

}
