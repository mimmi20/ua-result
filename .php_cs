<?php

$header = <<<EOF
This file is part of the ua-result package.

Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@PSR2' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['align_double_arrow' => true, 'align_equals' => true],
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => false,
        'blank_line_before_return' => true,
        'braces' => ['allow_single_line_closure' => false],
        'cast_spaces' => true,
        'class_definition' => ['singleLine' => false, 'singleItemSingleLine' => true, 'multiLineExtendsEachSingleLine' => true],
        'class_keyword_remove' => false,
        'combine_consecutive_unsets' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => ['space' => 'single'],
        'declare_strict_types' => true,
        'dir_constant' => true,
        'elseif' => true,
        'encoding' => true,
        'ereg_to_preg' => true,
        'full_opening_tag' => true,
        'function_declaration' => true,
        'function_typehint_space' => true,
        'general_phpdoc_annotation_remove' => ['expectedExceptionMessageRegExp', 'expectedException', 'expectedExceptionMessage'],
        'hash_to_slash_comment' => true,
        'header_comment' => ['header' => $header, 'commentType' => 'PHPDoc', 'location' => 'after_open', 'separate' => 'bottom'],
        'heredoc_to_nowdoc' => true,
        'include' => true,
        'indentation_type' => true,
        'is_null' => ['use_yoda_style' => true],
        'line_ending' => true,
        'linebreak_after_opening_tag' => true,
        'lowercase_cast' => true,
        'lowercase_constants' => true,
        'lowercase_keywords' => true,
        'mb_str_functions' => true,
        'method_argument_space' => true,
        'method_separation' => true,
        'modernize_types_casting' => true,
        'native_function_casing' => true,
        'native_function_invocation' => false,
        'new_with_braces' => true,
        'no_alias_functions' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => false,
        'no_blank_lines_before_namespace' => true,
        'no_closing_tag' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_consecutive_blank_lines' => ['break', 'continue', 'extra', 'return', 'throw', 'use', 'parenthesis_brace_block', 'square_brace_block', 'curly_brace_block'],
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => ['use' => 'echo'],
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_multiline_whitespace_before_semicolons' => true,
        'no_php4_constructor' => true,
        'no_short_bool_cast' => true,
        'no_short_echo_tag' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unreachable_default_argument_value' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'not_operator_with_space' => false,
        'not_operator_with_successor_space' => false,
        'object_operator_without_whitespace' => true,
        'ordered_class_elements' => false,
        'ordered_imports' => true,
        'php_unit_construct' => true,
        'php_unit_dedicate_assert' => true,
        'php_unit_fqcn_annotation' => true,
        'php_unit_strict' => false,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_align' => true,
        'phpdoc_inline_tag' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_alias_tag' => ['property-read' => 'property', 'property-write' => 'property', 'type' => 'var'],
        'phpdoc_no_empty_return' => false,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_return_self_reference' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => false,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        'pow_to_exponentiation' => false,
        'pre_increment' => true,
        'protected_to_private' => true,
        'psr0' => true,
        'psr4' => true,
        'random_api_migration' => true,
        'return_type_declaration' => true,
        'self_accessor' => true,
        'semicolon_after_instruction' => true,
        'short_scalar_cast' => true,
        'silenced_deprecation_error' => true,
        'simplified_null_return' => true,
        'single_blank_line_at_eof' => true,
        'single_blank_line_before_namespace' => false,
        'single_class_element_per_statement' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_quote' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'strict_comparison' => true,
        'strict_param' => false,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => false,
        'trailing_comma_in_multiline_array' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => true,
        'whitespace_after_comma_in_array' => true,
    ))
    ->setFinder($finder)
;
