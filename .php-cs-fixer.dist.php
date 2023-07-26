<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('build')
    ->exclude('vendor')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@DoctrineAnnotation' => true,
        '@PHP81Migration' => true,
        '@Symfony' => true,
        'align_multiline_comment' => true,
        'array_indentation' => true,
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'return', 'throw', 'yield'],
        ],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'concat_space' => ['spacing' => 'one'],
        'control_structure_continuation_position' => true,
        'declare_equal_normalize' => true,
        'declare_strict_types' => true,
        'function_declaration' => ['closure_function_spacing' => 'none'],
        'global_namespace_import' => true,
        'implode_call' => true,
        'is_null' => true,
        'method_chaining_indentation' => true,
        'modernize_types_casting' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'operator_linebreak' => true,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_line_span' => ['property' => 'single'],
        'phpdoc_order' => true,
        'phpdoc_summary' => false,
        'phpdoc_to_comment' => false,
        'psr_autoloading' => true,
        'return_assignment' => true,
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'single_line_throw' => false,
        'trailing_comma_in_multiline' => ['after_heredoc' => true, 'elements' => ['arrays', 'arguments', 'parameters']],
        'yoda_style' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ;
