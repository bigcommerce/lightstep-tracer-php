<?php

namespace LightStepBase;

/**
 * Interface for the instrumentation library.
 *
 * This interface is most commonly accessed via LightStep::getInstance()
 * singleton.
 */
interface Tracer {

    // ---------------------------------------------------------------------- //
    // OpenTracing API
    // ---------------------------------------------------------------------- //

    /**
     * Creates a span object to record the start and finish of an application
     * operation.  The span object can then be used to record further data
     * about this operation, such as which user it is being done on behalf
     * of and log records with arbitrary payload data.
     *
     * @param string $operationName the logical name to use for the operation
     *                              this span is tracking
     * @param array $fields optional array of key-value pairs. Valid pairs are:
     *        'parent' Span the span to use as this span's parent
     *        'tags' array string-string pairs to set as tags on this span
     *        'startTime' float Unix time (in milliseconds) representing the
     *        					start time of this span. Useful for retroactively
     *        					created spans.
     * @return Span
     */
    public function startSpan($operationName, $fields);

    /**
     * Copies the span data into the given carrier object.
     *
     * See http://opentracing.io/spec/#inject-and-join.
     *
     * @param  Span $span the span object that will populate $carrier
     * @param  string $format the OpenTracing constant for the format of $carrier
     * @param  mixed $carrier the carrier object; the type depends on the $format
     */
    public function inject(Span $span, $format, &$carrier);

    /**
     * Creates a new span data from the given carrier object.
     *
     * See http://opentracing.io/spec/#inject-and-join.
     *
     * @param  string $operationName operation name to use for the newly created
     *                               span
     * @param  string $format the OpenTracing constant for the format of the
     *                        carrier object
     * @param  mixed $carrier carrier object; the type depends on $format
     * @return Span the newly created Span
     */
    public function join($operationName, $format, $carrier);

    // ---------------------------------------------------------------------- //
    // LightStep Extentsions
    // ---------------------------------------------------------------------- //

    /**
     * Manually causes any buffered log and span records to be flushed to the
     * server. In most cases, explicit calls to flush() are not required as the
     * logs and spans are sent incrementally over time and at process exit.
     */
    public function flush();

    /**
     * Returns the generated unique identifier for the runtime.
     *
     * Note: the value is only valid *after* the runtime has been initialized.
     * If called before initialization, this method will return zero.
     *
     * @return int runtime GUID or zero if called before initialization
     */
    public function guid();

    /**
     * Disables all functionality of the runtime.  All methods are effectively
     * no-ops when in disabled mode.
     */
    public function disable();

    /**
     * Currently for internal use only.
     *
     * @param array $options
     */
    public function options($options);
}
