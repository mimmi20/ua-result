<?php
/**
 * Copyright (c) 2012-2015, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace UaResult;

use Psr\Log\LoggerInterface;
use UaHelper\Utils;
use UaMatcher\Version\VersionInterface;
use Wurfl\WurflConstants;

/**
 * BrowserDetector.ini parsing class with caching and update capabilities
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @property-read $id
 * @property-read $useragent
 */
class Result implements ResultInterface, \Serializable
{
    /**
     * an logger instance
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger = null;

    /**
     * @var string
     */
    protected $wurflKey = WurflConstants::NO_MATCH;

    /**
     * @var string
     */
    protected $useragent = null;

    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array(
        // kind of device
        'device_type'                                       => null, // not in wurfl
        'browser_type'                                      => null, // not in wurfl
        'is_wireless_device'                                => null,
        'is_tablet'                                         => null,
        'is_bot'                                            => null,
        'is_smarttv'                                        => null,
        'is_console'                                        => null,
        'is_syndication_reader'                             => null,
        'ux_full_desktop'                                   => null,
        'is_transcoder'                                     => null,
        'is_banned'                                         => null, // not in wurfl

        // device
        'model_name'                                        => null,
        'model_version'                                     => null, // not in wurfl
        'brand_name'                                        => null,
        'marketing_name'                                    => null,
        'manufacturer_name'                                 => null,
        'device_bits'                                       => null, // not in wurfl
        'device_cpu'                                        => null, // not in wurfl

        // product info
        'has_qwerty_keyboard'                               => null,
        'pointing_method'                                   => null,
        'can_skip_aligned_link_row'                         => null,
        'device_claims_web_support'                         => null,
        'can_assign_phone_number'                           => null,
        'release_date'                                      => null,
        'uaprof'                                            => null,
        'ununiqueness_handler'                              => null,
        'uaprof2'                                           => null,
        'uaprof3'                                           => null,
        'model_extra_info'                                  => null,
        'unique'                                            => null,
        'nokia_feature_pack'                                => null,
        'nokia_series'                                      => null,
        'nokia_edition'                                     => null,
        // display
        'physical_screen_width'                             => null,
        'physical_screen_height'                            => null,
        'columns'                                           => null,
        'rows'                                              => null,
        'max_image_width'                                   => null,
        'max_image_height'                                  => null,
        'resolution_width'                                  => null,
        'resolution_height'                                 => null,
        'dual_orientation'                                  => null,
        'colors'                                            => null,
        // browser
        'mobile_browser'                                    => null,
        'mobile_browser_version'                            => null,
        'mobile_browser_bits'                               => null, // not in wurfl
        'mobile_browser_manufacturer'                       => null, // not in wurfl
        'mobile_browser_brand_name'                         => null, // not in wurfl
        'mobile_browser_modus'                              => null, // not in wurfl
        'mobile_browser_icon'                               => null, // not in wurfl

        // os
        'device_os'                                         => null,
        'device_os_version'                                 => null,
        'device_os_bits'                                    => null, // not in wurfl
        'device_os_manufacturer'                            => null, // not in wurfl
        'device_os_brand_name'                              => null, // not in wurfl
        'device_os_icon'                                    => null, // not in wurfl

        // engine
        'renderingengine_name'                              => null, // not in wurfl
        'renderingengine_version'                           => null, // not in wurfl
        'renderingengine_manufacturer'                      => null, // not in wurfl
        'renderingengine_brand_name'                        => null, // not in wurfl
        'renderingengine_icon'                              => null, // not in wurfl

        // virtual
        'controlcap_is_app'                                 => null,
        'controlcap_is_mobile'                              => null,
        'controlcap_is_robot'                               => null,
        'controlcap_is_mobilephone'                         => null,
        'controlcap_is_ios'                                 => null,
        'controlcap_is_android'                             => null,
        'controlcap_is_windows_phone'                       => null,
        'controlcap_is_touchscreen'                         => null,
        'controlcap_is_full_desktop'                        => null,
        'controlcap_is_html_preferred'                      => null,
        'controlcap_is_wml_preferred'                       => null,
        'controlcap_is_xhtmlmp_preferred'                   => null,
        'controlcap_is_largescreen'                         => null,
        'controlcap_advertised_browser'                     => null,
        'controlcap_advertised_browser_version'             => null,
        'controlcap_advertised_device_os'                   => null,
        'controlcap_advertised_device_os_version'           => null,
        'controlcap_form_factor'                            => null,
        'controlcap_is_smartphone'                          => null,
        // markup
        'html_web_3_2'                                      => null,
        'html_wi_oma_xhtmlmp_1_0'                           => null,
        'wml_1_1'                                           => null,
        'xhtml_support_level'                               => null,
        'preferred_markup'                                  => null,
        'html_web_4_0'                                      => null,
        'html_wi_imode_htmlx_1'                             => null,
        'html_wi_imode_html_1'                              => null,
        'html_wi_imode_html_2'                              => null,
        'html_wi_w3_xhtmlbasic'                             => null,
        'html_wi_imode_compact_generic'                     => null,
        'html_wi_imode_html_3'                              => null,
        'html_wi_imode_html_4'                              => null,
        'wml_1_2'                                           => null,
        'html_wi_imode_html_5'                              => null,
        'wml_1_3'                                           => null,
        'voicexml'                                          => null,
        'html_wi_imode_htmlx_1_1'                           => null,
        'multipart_support'                                 => null,
        'supports_background_sounds'                        => null, // not in wurfl
        'supports_vb_script'                                => null, // not in wurfl
        'supports_java_applets'                             => null, // not in wurfl
        'supports_activex_controls'                         => null, // not in wurfl

        // chtml
        'chtml_table_support'                               => null,
        'imode_region'                                      => null,
        'chtml_can_display_images_and_text_on_same_line'    => null,
        'chtml_displays_image_in_center'                    => null,
        'chtml_make_phone_call_string'                      => null,
        'chtml_display_accesskey'                           => null,
        'emoji'                                             => null,
        // xhtml
        'xhtml_select_as_radiobutton'                       => null,
        'xhtml_avoid_accesskeys'                            => null,
        'xhtml_select_as_dropdown'                          => null,
        'xhtml_supports_iframe'                             => null,
        'xhtml_supports_frame'                              => null, // not in wurfl
        'xhtml_supports_forms_in_table'                     => null,
        'xhtmlmp_preferred_mime_type'                       => null,
        'xhtml_select_as_popup'                             => null,
        'xhtml_honors_bgcolor'                              => null,
        'xhtml_file_upload'                                 => null,
        'xhtml_preferred_charset'                           => null,
        'xhtml_supports_css_cell_table_coloring'            => null,
        'xhtml_autoexpand_select'                           => null,
        'accept_third_party_cookie'                         => null,
        'xhtml_make_phone_call_string'                      => null,
        'xhtml_allows_disabled_form_elements'               => null,
        'xhtml_supports_invisible_text'                     => null,
        'cookie_support'                                    => null,
        'xhtml_send_mms_string'                             => null,
        'xhtml_table_support'                               => null,
        'xhtml_display_accesskey'                           => null,
        'xhtml_can_embed_video'                             => null,
        'xhtml_supports_monospace_font'                     => null,
        'xhtml_supports_inline_input'                       => null,
        'xhtml_document_title_support'                      => null,
        'xhtml_support_wml2_namespace'                      => null,
        'xhtml_readable_background_color1'                  => null,
        'xhtml_format_as_attribute'                         => null,
        'xhtml_supports_table_for_layout'                   => null,
        'xhtml_readable_background_color2'                  => null,
        'xhtml_send_sms_string'                             => null,
        'xhtml_format_as_css_property'                      => null,
        'opwv_xhtml_extensions_support'                     => null,
        'xhtml_marquee_as_css_property'                     => null,
        'xhtml_nowrap_mode'                                 => null,
        // image format
        'jpg'                                               => null,
        'gif'                                               => null,
        'bmp'                                               => null,
        'wbmp'                                              => null,
        'gif_animated'                                      => null,
        'png'                                               => null,
        'greyscale'                                         => null,
        'transparent_png_index'                             => null,
        'epoc_bmp'                                          => null,
        'svgt_1_1_plus'                                     => null,
        'svgt_1_1'                                          => null,
        'transparent_png_alpha'                             => null,
        'tiff'                                              => null,
        // security
        'https_support'                                     => null,
        'phone_id_provided'                                 => false,
        // storage
        'max_deck_size'                                     => null,
        'max_length_of_username'                            => null,
        'max_url_length_bookmark'                           => null,
        'max_no_of_bookmarks'                               => null,
        'max_url_length_cached_page'                        => null,
        'max_length_of_password'                            => null,
        'max_no_of_connection_settings'                     => null,
        'max_url_length_in_requests'                        => null,
        'max_object_size'                                   => null,
        'max_url_length_homepage'                           => null,
        // ajax
        'ajax_support_getelementbyid'                       => null,
        'ajax_xhr_type'                                     => null,
        'ajax_support_event_listener'                       => null,
        'ajax_support_javascript'                           => null,
        'ajax_manipulate_dom'                               => null,
        'ajax_support_inner_html'                           => null,
        'ajax_manipulate_css'                               => null,
        'ajax_support_events'                               => null,
        'ajax_preferred_geoloc_api'                         => null,
        // wml
        'wml_make_phone_call_string'                        => null,
        'card_title_support'                                => null,
        'table_support'                                     => null,
        'elective_forms_recommended'                        => null,
        'menu_with_list_of_links_recommended'               => null,
        'break_list_of_links_with_br_element_recommended'   => null,
        'icons_on_menu_items_support'                       => null,
        'opwv_wml_extensions_support'                       => null,
        'built_in_back_button_support'                      => null,
        'proportional_font'                                 => null,
        'insert_br_element_after_widget_recommended'        => null,
        'wizards_recommended'                               => null,
        'wml_can_display_images_and_text_on_same_line'      => null,
        'softkey_support'                                   => null,
        'deck_prefetch_support'                             => null,
        'menu_with_select_element_recommended'              => null,
        'numbered_menus'                                    => null,
        'image_as_link_support'                             => null,
        'wrap_mode_support'                                 => null,
        'access_key_support'                                => null,
        'wml_displays_image_in_center'                      => null,
        'times_square_mode_support'                         => null,
        // pdf
        'pdf_support'                                       => null,
        // third_party
        'jqm_grade'                                         => null,
        'is_sencha_touch_ok'                                => null,
        // html
        'image_inlining'                                    => null,
        'canvas_support'                                    => null,
        'viewport_width'                                    => null,
        'html_preferred_dtd'                                => null,
        'viewport_supported'                                => null,
        'viewport_minimum_scale'                            => null,
        'viewport_initial_scale'                            => null,
        'mobileoptimized'                                   => null,
        'viewport_maximum_scale'                            => null,
        'viewport_userscalable'                             => null,
        'handheldfriendly'                                  => null,
        // css
        'css_spriting'                                      => null,
        'css_gradient'                                      => null,
        'css_gradient_linear'                               => null,
        'css_border_image'                                  => null,
        'css_rounded_corners'                               => null,
        'css_supports_width_as_percentage'                  => null,
        // bugs
        'emptyok'                                           => null,
        'empty_option_value_support'                        => null,
        'basic_authentication_support'                      => null,
        'post_method_support'                               => null,
        // rss
        'rss_support'                                       => null,
        // sms
        'sms_enabled'                                       => null,
        'ems'                                               => null,
        'text_imelody'                                      => null,
        'nokiaring'                                         => null,
        'siemens_logo_height'                               => null,
        'ems_variablesizedpictures'                         => null,
        'sckl_groupgraphic'                                 => null,
        'siemens_ota'                                       => null,
        'sagem_v1'                                          => null,
        'largeoperatorlogo'                                 => null,
        'sagem_v2'                                          => null,
        'ems_version'                                       => null,
        'ems_odi'                                           => null,
        'nokiavcal'                                         => null,
        'operatorlogo'                                      => null,
        'siemens_logo_width'                                => null,
        'ems_imelody'                                       => null,
        'sckl_vcard'                                        => null,
        'siemens_screensaver_width'                         => null,
        'sckl_operatorlogo'                                 => null,
        'panasonic'                                         => null,
        'ems_upi'                                           => null,
        'nokiavcard'                                        => null,
        'callericon'                                        => null,
        'gprtf'                                             => null,
        'siemens_screensaver_height'                        => null,
        'sckl_ringtone'                                     => null,
        'picturemessage'                                    => null,
        'sckl_vcalendar'                                    => null,
        // bearer
        'has_cellular_radio'                                => null,
        'sdio'                                              => null,
        'wifi'                                              => null,
        'max_data_rate'                                     => null,
        'vpn'                                               => null,
        // flash_lite
        'full_flash_support'                                => null,
        'flash_lite_version'                                => null,
        'fl_wallpaper'                                      => null,
        'fl_browser'                                        => null,
        'fl_screensaver'                                    => null,
        'fl_standalone'                                     => null,
        'fl_sub_lcd'                                        => null,
        // cache
        'time_to_live_support'                              => null,
        'total_cache_disable_support'                       => null,
        // wta
        'nokia_voice_call'                                  => null,
        'wta_pdc'                                           => null,
        'wta_voice_call'                                    => null,
        'wta_misc'                                          => null,
        'wta_phonebook'                                     => null,
        // object download
        'video'                                             => null,
        'picture_bmp'                                       => null,
        'picture'                                           => null,
        'wallpaper_df_size_limit'                           => null,
        'picture_preferred_width'                           => null,
        'wallpaper_oma_size_limit'                          => null,
        'picture_greyscale'                                 => null,
        'inline_support'                                    => null,
        'ringtone_qcelp'                                    => null,
        'screensaver_oma_size_limit'                        => null,
        'screensaver_wbmp'                                  => null,
        'picture_resize'                                    => null,
        'picture_preferred_height'                          => null,
        'ringtone_rmf'                                      => null,
        'wallpaper_wbmp'                                    => null,
        'wallpaper_jpg'                                     => null,
        'screensaver_bmp'                                   => null,
        'screensaver_max_width'                             => null,
        'picture_inline_size_limit'                         => null,
        'picture_colors'                                    => null,
        'ringtone_midi_polyphonic'                          => null,
        'ringtone_midi_monophonic'                          => null,
        'screensaver_preferred_height'                      => null,
        'ringtone_voices'                                   => null,
        'ringtone_3gpp'                                     => null,
        'oma_support'                                       => null,
        'ringtone_inline_size_limit'                        => null,
        'wallpaper_preferred_width'                         => null,
        'wallpaper_greyscale'                               => null,
        'screensaver_preferred_width'                       => null,
        'wallpaper_preferred_height'                        => null,
        'picture_max_width'                                 => null,
        'picture_jpg'                                       => null,
        'ringtone_aac'                                      => null,
        'ringtone_oma_size_limit'                           => null,
        'wallpaper_directdownload_size_limit'               => null,
        'screensaver_inline_size_limit'                     => null,
        'ringtone_xmf'                                      => null,
        'picture_max_height'                                => null,
        'screensaver_max_height'                            => null,
        'ringtone_mp3'                                      => null,
        'wallpaper_png'                                     => null,
        'screensaver_jpg'                                   => null,
        'ringtone_directdownload_size_limit'                => null,
        'wallpaper_max_width'                               => null,
        'wallpaper_max_height'                              => null,
        'screensaver'                                       => null,
        'ringtone_wav'                                      => null,
        'wallpaper_gif'                                     => null,
        'screensaver_directdownload_size_limit'             => null,
        'picture_df_size_limit'                             => null,
        'wallpaper_tiff'                                    => null,
        'screensaver_df_size_limit'                         => null,
        'ringtone_awb'                                      => null,
        'ringtone'                                          => null,
        'wallpaper_inline_size_limit'                       => null,
        'picture_directdownload_size_limit'                 => null,
        'picture_png'                                       => null,
        'wallpaper_bmp'                                     => null,
        'picture_wbmp'                                      => null,
        'ringtone_df_size_limit'                            => null,
        'picture_oma_size_limit'                            => null,
        'picture_gif'                                       => null,
        'screensaver_png'                                   => null,
        'wallpaper_resize'                                  => null,
        'screensaver_greyscale'                             => null,
        'ringtone_mmf'                                      => null,
        'ringtone_amr'                                      => null,
        'wallpaper'                                         => null,
        'ringtone_digiplug'                                 => null,
        'ringtone_spmidi'                                   => null,
        'ringtone_compactmidi'                              => null,
        'ringtone_imelody'                                  => null,
        'screensaver_resize'                                => null,
        'wallpaper_colors'                                  => null,
        'directdownload_support'                            => null,
        'downloadfun_support'                               => null,
        'screensaver_colors'                                => null,
        'screensaver_gif'                                   => null,
        // drm
        'oma_v_1_0_combined_delivery'                       => null,
        'oma_v_1_0_separate_delivery'                       => null,
        'oma_v_1_0_forwardlock'                             => null,
        // streaming
        'streaming_vcodec_mpeg4_asp'                        => null,
        'streaming_video_size_limit'                        => null,
        'streaming_mov'                                     => null,
        'streaming_wmv'                                     => null,
        'streaming_acodec_aac'                              => null,
        'streaming_vcodec_h263_0'                           => null,
        'streaming_real_media'                              => null,
        'streaming_3g2'                                     => null,
        'streaming_3gpp'                                    => null,
        'streaming_acodec_amr'                              => null,
        'streaming_vcodec_h264_bp'                          => null,
        'streaming_vcodec_h263_3'                           => null,
        'streaming_preferred_protocol'                      => null,
        'streaming_vcodec_mpeg4_sp'                         => null,
        'streaming_flv'                                     => null,
        'streaming_video'                                   => null,
        'streaming_preferred_http_protocol'                 => null,
        'streaming_mp4'                                     => null,
        // wap push
        'expiration_date'                                   => null,
        'utf8_support'                                      => null,
        'connectionless_cache_operation'                    => null,
        'connectionless_service_load'                       => null,
        'iso8859_support'                                   => null,
        'connectionoriented_confirmed_service_indication'   => null,
        'connectionless_service_indication'                 => null,
        'ascii_support'                                     => null,
        'connectionoriented_confirmed_cache_operation'      => null,
        'connectionoriented_confirmed_service_load'         => null,
        'wap_push_support'                                  => null,
        'connectionoriented_unconfirmed_cache_operation'    => null,
        'connectionoriented_unconfirmed_service_load'       => null,
        'connectionoriented_unconfirmed_service_indication' => null,
        // j2me
        'doja_1_5'                                          => null,
        'j2me_datefield_broken'                             => null,
        'j2me_clear_key_code'                               => null,
        'j2me_right_softkey_code'                           => null,
        'j2me_heap_size'                                    => null,
        'j2me_canvas_width'                                 => null,
        'j2me_motorola_lwt'                                 => null,
        'doja_3_5'                                          => null,
        'j2me_wbmp'                                         => null,
        'j2me_rmf'                                          => null,
        'j2me_wma'                                          => null,
        'j2me_left_softkey_code'                            => null,
        'j2me_jtwi'                                         => null,
        'j2me_jpg'                                          => null,
        'j2me_return_key_code'                              => null,
        'j2me_real8'                                        => null,
        'j2me_max_record_store_size'                        => null,
        'j2me_realmedia'                                    => null,
        'j2me_midp_1_0'                                     => null,
        'j2me_bmp3'                                         => null,
        'j2me_midi'                                         => null,
        'j2me_btapi'                                        => null,
        'j2me_locapi'                                       => null,
        'j2me_siemens_extension'                            => null,
        'j2me_h263'                                         => null,
        'j2me_audio_capture_enabled'                        => null,
        'j2me_midp_2_0'                                     => null,
        'j2me_datefield_no_accepts_null_date'               => null,
        'j2me_aac'                                          => null,
        'j2me_capture_image_formats'                        => null,
        'j2me_select_key_code'                              => null,
        'j2me_xmf'                                          => null,
        'j2me_photo_capture_enabled'                        => null,
        'j2me_realaudio'                                    => null,
        'j2me_realvideo'                                    => null,
        'j2me_mp3'                                          => null,
        'j2me_png'                                          => null,
        'j2me_au'                                           => null,
        'j2me_screen_width'                                 => null,
        'j2me_mp4'                                          => null,
        'j2me_mmapi_1_0'                                    => null,
        'j2me_http'                                         => null,
        'j2me_imelody'                                      => null,
        'j2me_socket'                                       => null,
        'j2me_3dapi'                                        => null,
        'j2me_bits_per_pixel'                               => null,
        'j2me_mmapi_1_1'                                    => null,
        'j2me_udp'                                          => null,
        'j2me_wav'                                          => null,
        'j2me_middle_softkey_code'                          => null,
        'j2me_svgt'                                         => null,
        'j2me_gif'                                          => null,
        'j2me_siemens_color_game'                           => null,
        'j2me_max_jar_size'                                 => null,
        'j2me_wmapi_1_0'                                    => null,
        'j2me_nokia_ui'                                     => null,
        'j2me_screen_height'                                => null,
        'j2me_wmapi_1_1'                                    => null,
        'j2me_wmapi_2_0'                                    => null,
        'doja_1_0'                                          => null,
        'j2me_serial'                                       => null,
        'doja_2_0'                                          => null,
        'j2me_bmp'                                          => null,
        'j2me_amr'                                          => null,
        'j2me_gif89a'                                       => null,
        'j2me_cldc_1_0'                                     => null,
        'doja_2_1'                                          => null,
        'doja_3_0'                                          => null,
        'j2me_cldc_1_1'                                     => null,
        'doja_2_2'                                          => null,
        'doja_4_0'                                          => null,
        'j2me_3gpp'                                         => null,
        'j2me_video_capture_enabled'                        => null,
        'j2me_canvas_height'                                => null,
        'j2me_https'                                        => null,
        'j2me_mpeg4'                                        => null,
        'j2me_storage_size'                                 => null,
        // mms
        'mms_3gpp'                                          => null,
        'mms_wbxml'                                         => null,
        'mms_symbian_install'                               => null,
        'mms_png'                                           => null,
        'mms_max_size'                                      => null,
        'mms_rmf'                                           => null,
        'mms_nokia_operatorlogo'                            => null,
        'mms_max_width'                                     => null,
        'mms_max_frame_rate'                                => null,
        'mms_wml'                                           => null,
        'mms_evrc'                                          => null,
        'mms_spmidi'                                        => null,
        'mms_gif_static'                                    => null,
        'mms_max_height'                                    => null,
        'sender'                                            => null,
        'mms_video'                                         => null,
        'mms_vcard'                                         => null,
        'mms_nokia_3dscreensaver'                           => null,
        'mms_qcelp'                                         => null,
        'mms_midi_polyphonic'                               => null,
        'mms_wav'                                           => null,
        'mms_jpeg_progressive'                              => null,
        'mms_jad'                                           => null,
        'mms_nokia_ringingtone'                             => null,
        'built_in_recorder'                                 => null,
        'mms_midi_monophonic'                               => null,
        'mms_3gpp2'                                         => null,
        'mms_wmlc'                                          => null,
        'mms_nokia_wallpaper'                               => null,
        'mms_bmp'                                           => null,
        'mms_vcalendar'                                     => null,
        'mms_jar'                                           => null,
        'mms_ota_bitmap'                                    => null,
        'mms_mp3'                                           => null,
        'mms_mmf'                                           => null,
        'mms_amr'                                           => null,
        'mms_wbmp'                                          => null,
        'built_in_camera'                                   => null,
        'receiver'                                          => null,
        'mms_mp4'                                           => null,
        'mms_xmf'                                           => null,
        'mms_jpeg_baseline'                                 => null,
        'mms_midi_polyphonic_voices'                        => null,
        'mms_gif_animated'                                  => null,
        // sound format
        'rmf'                                               => null,
        'qcelp'                                             => null,
        'awb'                                               => null,
        'smf'                                               => null,
        'wav'                                               => null,
        'nokia_ringtone'                                    => null,
        'aac'                                               => null,
        'digiplug'                                          => null,
        'sp_midi'                                           => null,
        'compactmidi'                                       => null,
        'voices'                                            => null,
        'mp3'                                               => null,
        'mld'                                               => null,
        'evrc'                                              => null,
        'amr'                                               => null,
        'xmf'                                               => null,
        'mmf'                                               => null,
        'imelody'                                           => null,
        'midi_monophonic'                                   => null,
        'au'                                                => null,
        'midi_polyphonic'                                   => null,
        // transcoding
        'transcoder_ua_header'                              => null,
        // playback
        'playback_oma_size_limit'                           => null,
        'playback_acodec_aac'                               => null,
        'playback_vcodec_h263_3'                            => null,
        'playback_vcodec_mpeg4_asp'                         => null,
        'playback_mp4'                                      => null,
        'playback_3gpp'                                     => null,
        'playback_df_size_limit'                            => null,
        'playback_acodec_amr'                               => null,
        'playback_mov'                                      => null,
        'playback_wmv'                                      => null,
        'playback_acodec_qcelp'                             => null,
        'progressive_download'                              => null,
        'playback_directdownload_size_limit'                => null,
        'playback_real_media'                               => null,
        'playback_3g2'                                      => null,
        'playback_vcodec_mpeg4_sp'                          => null,
        'playback_vcodec_h263_0'                            => null,
        'playback_inline_size_limit'                        => null,
        'hinted_progressive_download'                       => null,
        'playback_vcodec_h264_bp'                           => null,
        // chips
        'nfc_support'                                       => null,
    );

    /**
     * the class constructor
     *
     * @param string                              $useragent
     * @param \Psr\Log\LoggerInterface            $logger
     * @param string|null                         $wurflKey
     */
    public function __construct(
        $useragent,
        LoggerInterface $logger,
        $wurflKey = WurflConstants::NO_MATCH
    ) {
        $this->logger    = $logger;
        $this->useragent = $useragent;
        $this->wurflKey  = $wurflKey;

        $detector = new Version();
        $detector->setVersion('');

        $this->setCapability('mobile_browser_version', clone $detector);
        $this->setCapability('renderingengine_version', clone $detector);
        $this->setCapability('device_os_version', clone $detector);
        $this->setCapability('model_version', clone $detector);
    }

    /**
     * Returns the value of a given capability name for the current device
     *
     * @param string $capabilityName must be a valid capability name
     * @param string $capabilityValue
     *
     * @throws \InvalidArgumentException
     * @return \UaResult\Result
     */
    public function setCapability(
        $capabilityName,
        $capabilityValue = null
    ) {
        $this->checkCapability($capabilityName);

        $versionfields = array(
            'mobile_browser_version',
            'renderingengine_version',
            'device_os_version'
        );

        if (in_array($capabilityName, $versionfields) && !($capabilityValue instanceof Version)) {
            throw new \InvalidArgumentException(
                'capability "' . $capabilityName . '" requires an instance of '
                . '"\\UaResult\\Version" as value, instance of "' . get_class($capabilityValue) . '" given'
            );
        }

        $this->properties[$capabilityName] = $capabilityValue;

        return $this;
    }

    /**
     * Returns the value of a given capability name
     * for the current device
     *
     * @param string $capabilityName must be a valid capability name
     *
     * @throws \InvalidArgumentException
     * @return string Capability value
     */
    protected function checkCapability($capabilityName)
    {
        if (empty($capabilityName)) {
            throw new \InvalidArgumentException(
                'capability name must not be empty'
            );
        }

        if (!array_key_exists($capabilityName, $this->properties)) {
            throw new \InvalidArgumentException(
                'no capability named [' . $capabilityName . '] is present. [' . json_encode($this->properties) . ']'
            );
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(
            array(
                'properties' => $this->properties,
                'wurflKey'   => $this->wurflKey,
                'useragent'  => $this->useragent,
            )
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $data <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($data)
    {
        $unseriliazedData = unserialize($data);

        foreach ($unseriliazedData['properties'] as $property => $value) {
            $this->properties[$property] = $value;
        }

        $this->wurflKey  = $unseriliazedData['wurflKey'];
        $this->useragent = $unseriliazedData['useragent'];
    }

    /**
     * Returns the values of all capabilities for the current device
     *
     * @return string[] All Capability values
     */
    public function getCapabilities()
    {
        return $this->getAllCapabilities();
    }

    /**
     * Returns the values of all capabilities for the current device
     *
     * @return string[] All Capability values
     */
    public function getAllCapabilities()
    {
        return $this->properties;
    }

    /**
     * Returns the value of a given capability name for the current result
     *
     * @param string $name must be a valid name of an virtual capability
     *
     * @return string|VersionInterface Capability value
     */
    public function getVirtualCapability($name)
    {
        $name = 'controlcap_' . $name;

        return $this->getCapability($name);
    }

    /**
     * Returns the value of a given capability name for the current device
     *
     * @param string $capabilityName must be a valid capability name
     *
     * @return string|VersionInterface Capability value
     * @throws \InvalidArgumentException
     */
    public function getCapability($capabilityName)
    {
        $this->checkCapability($capabilityName);

        return $this->properties[$capabilityName];
    }

    /**
     * Returns the values of all capabilities for the current device
     *
     * @return string[] All virtual Capability values
     */
    public function getAllVirtualCapabilities()
    {
        $properties = array();

        foreach ($this->properties as $property => $value) {
            if ('controlcap_' === substr($property, 0, 11)) {
                $properties[substr($property, 12)] = $value;
            }
        }

        return $properties;
    }

    /**
     * Returns the value of a given capability name for the current device
     *
     * @param array $capabilities An array of name/value pairs
     *
     * @return \UaResult\Result
     */
    public function setCapabilities(array $capabilities)
    {
        foreach ($capabilities as $capabilityName => $capabilityValue) {
            if (is_numeric($capabilityName)) {
                continue;
            }

            try {
                $this->setCapability($capabilityName, $capabilityValue);
            } catch (\Exception $e) {
                continue;
            }
        }

        return $this;
    }

    /**
     * Magic Method
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     * @return string
     */
    public function __get($name)
    {
        if (isset($name)) {
            switch ($name) {
                case 'id':
                    return $this->wurflKey;
                    break;
                case 'useragent':
                    return $this->useragent;
                    break;
                case 'fallBack':
                case 'actualDeviceRoot':
                    return null;
                    break;
                default:
                    // nothing to do here
                    break;
            }
        }

        throw new \InvalidArgumentException(
            'the property "' . $name . '" is not defined'
        );
    }

    /**
     * returns the name of the browser including the company brand name, the browser version and the browser modes
     *
     * @param bool    $withBits
     * @param integer $mode
     *
     * @return string
     */
    public function getFullBrowser(
        $withBits = true,
        $mode = null
    ) {
        if (null === $mode) {
            $mode = Version::COMPLETE | Version::IGNORE_MICRO_IF_EMPTY;
        }

        $browser = $this->getFullBrowserName($withBits, $mode);

        return trim($browser);
    }

    /**
     * returns the name of the browser including the browser version and the browser modes
     *
     * @param bool    $withBits
     * @param integer $mode
     *
     * @return string
     */
    public function getFullBrowserName(
        $withBits = true,
        $mode = null
    ) {
        $browser = $this->getCapability('mobile_browser');

        if (!$browser) {
            return null;
        }

        if ('unknown' == strtolower($browser)) {
            return 'unknown';
        }

        if (null === $mode) {
            $mode = Version::COMPLETE | Version::IGNORE_MICRO_IF_EMPTY;
        }

        $version = $this->getCapability('mobile_browser_version')->getVersion(
            $mode
        );

        if ($browser != $version && '' != $version) {
            $browser .= ' ' . $version;
        }

        $additional = array();

        $modus = $this->getCapability('mobile_browser_modus');

        if ($modus) {
            $additional[] = $modus;
        }

        $bits = $this->getCapability('mobile_browser_bits');

        if ($bits && $withBits) {
            $additional[] = $bits . ' Bit';
        }

        $browser .= (!empty($additional) ? ' (' . implode(', ', $additional) . ')' : '');

        return trim($browser);
    }

    /**
     * returns the name of the platform including the company brand name, the platform version
     *
     * @param bool    $withBits
     * @param integer $mode
     *
     * @return mixed
     */
    public function getFullPlatform(
        $withBits = true,
        $mode = null
    ) {
        if (null === $mode) {
            $mode = Version::COMPLETE_IGNORE_EMPTY;
        }

        $os = $this->getFullPlatformName($withBits, $mode);

        return trim($os);
    }

    /**
     * returns the name of the platform including the platform version
     *
     * @param bool    $withBits
     * @param integer $mode
     *
     * @return mixed
     */
    public function getFullPlatformName(
        $withBits = true,
        $mode = null
    ) {
        $name = $this->getCapability('device_os');

        if (!$name) {
            return null;
        }

        if ('unknown' == strtolower($name)) {
            return 'unknown';
        }

        if (null === $mode) {
            $mode = Version::COMPLETE_IGNORE_EMPTY;
        }

        $version = $this->getCapability('device_os_version')->getVersion($mode);
        $bits    = $this->getCapability('device_os_bits');

        $os = $name . ($name != $version && '' != $version ? ' ' . $version : '')
            . (($bits && $withBits) ? ' (' . $bits . ' Bit)' : '');

        return trim($os);
    }

    /**
     * returns the name of the actual device with version
     *
     * @return string
     */
    public function getFullDevice()
    {
        $device = $this->getFullDeviceName();

        return trim($device);
    }

    /**
     * returns the name of the actual device with version
     *
     * @return string
     */
    public function getFullDeviceName()
    {
        $device = $this->getDeviceName();

        if (!$device) {
            return null;
        }

        if ('unknown' == strtolower($device)) {
            return 'unknown';
        }

        $version = $this->getCapability('model_version')->getVersion(Version::MAJORMINOR);
        $device .= ($device != $version && '' != $version ? ' ' . $version : '');

        return trim($device);
    }

    /**
     * return the Name of the rendering engine with the version
     *
     * @param integer $mode The format the version should be formated
     *
     * @return string
     */
    public function getFullEngine($mode = Version::COMPLETE_IGNORE_EMPTY)
    {
        $engine = $this->getFullEngineName($mode);

        return trim($engine);
    }

    /**
     * return the Name of the rendering engine with the version
     *
     * @param integer $mode The format the version should be formated
     *
     * @return string
     */
    public function getFullEngineName($mode = Version::COMPLETE_IGNORE_EMPTY)
    {
        $engine = $this->getCapability('renderingengine_name');

        if (!$engine) {
            return null;
        }

        if ('unknown' == strtolower($engine)) {
            return 'unknown';
        }

        if (null === $mode) {
            $mode = Version::COMPLETE_IGNORE_EMPTY;
        }

        $version = $this->getCapability('renderingengine_version')->getVersion(
            $mode
        );

        return trim(
            $engine . (($engine != $version && '' != $version) ? ' ' . $version : '')
        );
    }

    /**
     * returns the name of the actual device without version
     *
     * @return string
     */
    public function getDeviceName()
    {
        return $this->getCapability('model_name');
    }

    /**
     * @return string
     */
    public function getDeviceMarketingName()
    {
        return $this->getCapability('marketing_name');
    }

    /**
     * returns the veraion of the actual device
     *
     * @return string
     */
    public function getDeviceVersion()
    {
        return null;
    }

    /**
     * returns the manufacturer of the actual device
     *
     * @return string
     */
    public function getDeviceManufacturer()
    {
        $value = $this->getCapability('manufacturer_name');

        return $value;
    }

    /**
     * returns the brand of the actual device
     *
     * @return string
     */
    public function getDeviceBrand()
    {
        $value = $this->getCapability('brand_name');

        return $value;
    }

    /**
     * @return string
     */
    public function getDeviceType()
    {
        $type = $this->getVirtualCapability('form_factor');

        return $type;
    }

    /**
     * @return string
     */
    public function getBrowserType()
    {
        $type = $this->getCapability('browser_type');

        return $type;
    }

    /**
     * @return string
     */
    public function getDevicePointingMethod()
    {
        return $this->getCapability('pointing_method');
    }

    /**
     * @return int|null
     */
    public function getDeviceResolutionWidth()
    {
        return $this->getCapability('resolution_width');
    }

    /**
     * @return int|null
     */
    public function getDeviceResolutionHeight()
    {
        return $this->getCapability('resolution_height');
    }

    /**
     * @return bool
     */
    public function hasDeviceDualOrientation()
    {
        return $this->getCapability('dual_orientation');
    }

    /**
     * @return bool
     */
    public function hasDeviceTouchScreen()
    {
        return ($this->getDevicePointingMethod() === 'touchscreen');
    }

    /**
     * @return int
     */
    public function getDeviceColors()
    {
        return $this->getCapability('colors');
    }

    /**
     * @return bool
     */
    public function hasDeviceSmsEnabled()
    {
        return $this->getCapability('sms_enabled');
    }

    /**
     * @return bool
     */
    public function hasDeviceNfcSupport()
    {
        return $this->getCapability('nfc_support');
    }

    /**
     * @return bool
     */
    public function hasDeviceQwertyKeyboard()
    {
        return $this->getCapability('has_qwerty_keyboard');
    }

    /**
     * returns TRUE if the device supports RSS Feeds
     *
     * @return boolean
     */
    public function isRssSupported()
    {
        return $this->getCapability('rss_support');
    }

    /**
     * returns TRUE if the device supports PDF documents
     *
     * @return boolean
     */
    public function isPdfSupported()
    {
        return $this->getCapability('pdf_support');
    }

    /**
     * returns TRUE if the device is a mobile
     *
     * @return boolean
     */
    public function isMobileDevice()
    {
        return $this->getVirtualCapability('is_mobile');
    }

    /**
     * returns TRUE if the device is a tablet
     *
     * @return boolean
     */
    public function isTablet()
    {
        return $this->getCapability('is_tablet');
    }

    /**
     * @return bool
     */
    public function isPhone()
    {
        return $this->getVirtualCapability('is_mobilephone');
    }

    /**
     * @return bool
     */
    public function isSmartphone()
    {
        if (!$this->isMobileDevice()) {
            return false;
        }

        if ($this->isTablet()) {
            return false;
        }

        if (!$this->isPhone()) {
            return false;
        }

        if (!$this->hasDeviceTouchScreen()) {
            return false;
        }

        if ($this->getDeviceResolutionWidth() < 320) {
            return false;
        }

        $osVersion = (float)$this->getCapability('device_os_version')->getVersion(Version::MAJORMINOR);

        switch ($this->getCapability('device_os')) {
            case 'iOS':
                $isSmartPhone = ($osVersion >= 3.0);
                break;
            case 'Android':
                $isSmartPhone = ($osVersion >= 2.2);
                break;
            case 'Windows Phone OS':
                $isSmartPhone = true;
                break;
            case 'RIM OS':
                $isSmartPhone = ($osVersion >= 7.0);
                break;
            case 'webOS':
                $isSmartPhone = true;
                break;
            case 'MeeGo':
                $isSmartPhone = true;
                break;
            case 'Bada OS':
                $isSmartPhone = ($osVersion >= 2.0);
                break;
            default:
                $isSmartPhone = false;
                break;
        }

        return $isSmartPhone;
    }

    /**
     * returns TRUE if the device is a desktop device
     *
     * @return boolean
     */
    public function isDesktop()
    {
        return $this->getCapability('ux_full_desktop');
    }

    /**
     * returns TRUE if the device is a TV device
     *
     * @return boolean
     */
    public function isTvDevice()
    {
        return $this->getCapability('is_smarttv');
    }

    /**
     * returns TRUE if the device ia a game console
     *
     * @return boolean
     */
    public function isConsole()
    {
        return $this->getCapability('is_console');
    }

    /**
     * returns TRUE if the browser is a crawler
     *
     * @return boolean
     */
    public function isCrawler()
    {
        return $this->getCapability('is_bot');
    }

    /**
     * returns TRUE if the device is a Transcoder
     *
     * @return boolean
     */
    public function isTranscoder()
    {
        return $this->getCapability('is_transcoder');
    }

    /**
     * returns TRUE if the device is a Syndication Reader
     *
     * @return boolean
     */
    public function isSyndicationReader()
    {
        return $this->getCapability('is_syndication_reader');
    }

    /**
     * returns TRUE if the device is a Syndication Reader
     *
     * @return boolean
     */
    public function isBanned()
    {
        return $this->getCapability('is_banned');
    }

    /**
     * @return bool
     */
    public function isApp()
    {
        $ua    = $this->useragent;
        $utils = new Utils();
        $utils->setUserAgent($ua);

        if ($this->getCapability('device_os') == 'iOS' && !$utils->checkIfContains('Safari')) {
            return true;
        }

        $patterns = array(
            '^Dalvik',
            'Darwin/',
            'CFNetwork',
            '^Windows Phone Ad Client',
            '^NativeHost',
            '^AndroidDownloadManager',
            '-HttpClient',
            '^AppCake',
            'AppEngine-Google',
            'AppleCoreMedia',
            '^AppTrailers',
            '^ChoiceFM',
            '^ClassicFM',
            '^Clipfish',
            '^FaceFighter',
            '^Flixster',
            '^Gold/',
            '^GoogleAnalytics/',
            '^Heart/',
            '^iBrowser/',
            'iTunes-',
            '^Java/',
            '^LBC/3.',
            'Twitter',
            'Pinterest',
            '^Instagram',
            'FBAN',
            '#iP(hone|od|ad)[\d],[\d]#',
            // namespace notation (com.google.youtube)
            '#[a-z]{3,}(?:\.[a-z]+){2,}#',
            //Windows MSIE Webview
            'WebView',
        );

        foreach ($patterns as $pattern) {
            if ($pattern[0] === '#') {
                // Regex
                if (preg_match($pattern, $ua)) {
                    return true;
                    break;
                }
                continue;
            }

            // Substring matches are not abstracted for performance
            $patternLength = strlen($pattern);
            $uaLength      = strlen($ua);

            if ($pattern[0] === '^') {
                // Starts with
                if (strpos($ua, substr($pattern, 1)) === 0) {
                    return true;
                    break;
                }
            } elseif ($pattern[$patternLength - 1] === '$') {
                // Ends with
                $patternLength--;
                $pattern = substr($pattern, 0, $patternLength);
                if (strpos($ua, $pattern) === ($uaLength - $patternLength)) {
                    return true;
                    break;
                }
            } else {
                // Match anywhere
                if (strpos($ua, $pattern) !== false) {
                    return true;
                    break;
                }
            }
        }

        return false;
    }

    /**
     * returns TRUE if the browser supports Frames
     *
     * @return boolean
     */
    public function supportsFrames()
    {
        return $this->getCapability('xhtml_supports_frame');
    }

    /**
     * returns TRUE if the browser supports IFrames
     *
     * @return boolean
     */
    public function supportsIframes()
    {
        return $this->getCapability('xhtml_supports_iframe');
    }

    /**
     * returns TRUE if the browser supports Tables
     *
     * @return boolean
     */
    public function supportsTables()
    {
        return $this->getCapability('xhtml_table_support');
    }

    /**
     * returns TRUE if the browser supports Cookies
     *
     * @return boolean
     */
    public function supportsCookies()
    {
        return $this->getCapability('cookie_support');
    }

    /**
     * returns TRUE if the browser supports BackgroundSounds
     *
     * @return boolean
     */
    public function supportsBackgroundSounds()
    {
        return $this->getCapability('supports_background_sounds');
    }

    /**
     * returns TRUE if the browser supports JavaScript
     *
     * @return boolean
     */
    public function supportsJavaScript()
    {
        return $this->getCapability('ajax_support_javascript');
    }

    /**
     * returns TRUE if the browser supports VBScript
     *
     * @return boolean
     */
    public function supportsVbScript()
    {
        return $this->getCapability('supports_vb_script');
    }

    /**
     * returns TRUE if the browser supports Java Applets
     *
     * @return boolean
     */
    public function supportsJavaApplets()
    {
        return $this->getCapability('supports_java_applets');
    }

    /**
     * returns TRUE if the browser supports ActiveX Controls
     *
     * @return boolean
     */
    public function supportsActivexControls()
    {
        return $this->getCapability('supports_activex_controls');
    }

    /**
     * builds a atring for comparation with wurfl
     *
     * @return string
     */
    public function getComparationName()
    {
        return $this->getCapability('mobile_browser') . ' on ' . $this->getCapability('device_os') . ', '
            . $this->getDeviceName();
    }
}
