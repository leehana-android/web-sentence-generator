<?php
/**
 * Created by PhpStorm.
 * User: Hana
 * Date: 2015-08-18
 * Time: 오후 5:00
 */

require("vendor/autoload.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="webapp/js/webix/codebase/webix.css" type="text/css" media="screen" charset="utf-8">
    <script src="webapp/js/webix/codebase/webix.js" type="text/javascript" charset="utf-8"></script>
    <script src="webapp/js/jquery/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>

    <style type="text/css">
        body {
            background-color: #ddd;
        }
        .webix_view, .webix_el_box .webixtype_form {
            font-family: 'PT Sans', Tahoma, 'Nanum Gothic', 'Malgun Gothic', serif;
        }
        .t_center .webix_cell {
            text-align: center;
        }
        .webix_view.webix_form.word_input {
            border-radius: 6px;
        }
        .word_input.noun {
            background-color: #CD812B;
        }
        .word_input.verb {
            background-color: #F17075;
        }
        .word_input.adverb {
            background-color: #7B6A97;
        }
        .word_input.adjective {
            background-color: #608F63;
        }
        .word_input .webix_el_label {
            font-size: 30px;
            color: whitesmoke;
        }
        .main_container {
            margin: 0 auto;
        }
        .hide {
            display:none !important;
        }
        .inline_block {
            display: inline-block;
        }
        .love_heart {
            width: 100%;
            height: 100%;
            margin: auto 0;
            background-image: url("webapp/images/love_heart_512.png");
        }
        .love_heart div {
            font-size: 50px;
            margin: auto 0;
            padding-top: 200px;
            text-align: center;
        }
        .webix_ss_header .webix_hs_center table td div.webix_hcell {
            text-align: center;
        }
    </style>
</head>
<body>
<script type="text/javascript" charset="UTF-8">
    "use strict";

    function isUndefined(value) {return typeof value === "undefined";}

    if (isUndefined(window.sg)) {
        window.sg = {
            context : {
                currentMenuId : "show_word"
            },
            word : {
                noun: {id: "noun", name:"명사"},
                verb: {id: "verb", name:"동사"},
                adverb: {id: "adverb", name: "부사"},
                adjective: {id: "adjective", name: "형용사"}
            }
        }
    }

    function showLovePopup() {
        webix.ui({
            view:"popup",
            width: 542, height:542,
            position:"center",
            head:"사랑합니다",
            body: {
                template:"<div class='love_heart'><div>사랑합니다</div></div>"
            }
        }).show();
    }

    function makeWordDataTable(wordId) {
        return {
            id: wordId, view: "datatable", columns: [
                {id: "number", header: "No.", width: 50, css: "t_center"},
                {id: "noun_checkbox", header: {content: "masterCheckbox"}, checkValue: "on", uncheckValue: "off", template: "{common.checkbox()}", width: 40},
                {id: "word", header: "단어", fillspace: true},
                {id: "created", header: "만든날", width: 200, css: "t_center"}
            ],
            data: getWordData(wordId),
            select:true
        }
    }

    function getWordData(wordId) {
        var dataResult = [];
        var dataTemplate = {id: 1, number: "1", word: "감사합니다", created: "2015-08-19 19:49:00"};
        switch (wordId) {
            case sg.word.noun.id:
                dataResult.push({id: 1, number: "1", word: "감사합니다-1", created: "2015-08-19 19:49:00"});
                dataResult.push({id: 2, number: "2", word: "감사합니다-2", created: "2015-08-19 19:49:00"});
                break;
            case sg.word.verb.id:
                dataResult.push({id: 1, number: "1", word: "감사합니다-1", created: "2015-08-19 19:49:00"});
                dataResult.push({id: 2, number: "2", word: "감사합니다-2", created: "2015-08-19 19:49:00"});
                break;
            case sg.word.adverb.id:
                dataResult.push({id: 1, number: "1", word: "감사합니다-1", created: "2015-08-19 19:49:00"});
                dataResult.push({id: 2, number: "2", word: "감사합니다-2", created: "2015-08-19 19:49:00"});
                break;
            case sg.word.adjective.id:
                dataResult.push({id: 1, number: "1", word: "감사합니다-1", created: "2015-08-19 19:49:00"});
                dataResult.push({id: 2, number: "2", word: "감사합니다-2", created: "2015-08-19 19:49:00"});
                break;
            default :
                break;
        }

        return dataResult;
    }

    var topToolbar = {
        id:"toolbar", view:"toolbar",cols:[
            { view:"label", template: "Sentence Generator 시어 생성기 사랑합니다♥"},
            {
                id:"show_word", view:"button", type:"icon", icon:"envelope", label:"단어보기", width:100, align:"left", on:{
                    onItemClick:function(id) {
                        if (sg.context.currentMenuId !== "show_word") {
                            $$("body_layout").removeView("side_menu");
                            $$("body_layout").addView(wordListMenu, 0);
                            $$("side_menu").select(1);
                        }

                        sg.context.currentMenuId = "show_word";
                    }
                }
            },
            {
                id:"show_favorite", view:"button", type:"icon", icon:"users", label:"즐겨찾기", width:100, align:"left", on:{
                    onItemClick:function(id) {
                        if (sg.context.currentMenuId !== "show_favorite") {
                            $$("body_layout").removeView("side_menu");
                            $$("body_layout").addView(favoriteMenu, 0);
                            $$("side_menu").select(1);
                        }

                        sg.context.currentMenuId = "show_favorite";
                    }
                }
            },
            {
                id:"show_generate", view:"button", type:"icon", icon:"cog", label:"문장생성", width:100, align:"left", on:{
                    onItemClick:function(id) {
                        if (sg.context.currentMenuId !== "show_generate") {
                            $$("body_layout").removeView("side_menu");
                            $$("body_layout").addView(generateMenu, 0);
                            $$("side_menu").select(1);
                        }

                        sg.context.currentMenuId = "show_generate";
                    }
                }
            }
        ]
    };

    var wordInputForm = {
        view: "form", id: "word_input_form", css: "word_input noun", elements: [
            {id:"word_input_title", view: "label", label: "명사"},
            {
                cols: [
                    {
                        view: "text", label: "", on:{
                            onKeyPress: function(keyCode, event) {
                                if (keyCode === 13) {
                                    showLovePopup();
                                }
                            }
                        }
                    },
                    {
                        view: "button", value: "입력", type: "form", width: 100, on:{
                            onItemClick: function(id, event) {
                                showLovePopup();
                                return false;
                            }
                        }
                    }
                ]
            }
        ]
    };

    var wordListTabBar = {
        id:"tabbar", view: "tabbar", value:sg.word.noun.id, multiview:true, options: [
            {id: sg.word.noun.id, value: sg.word.noun.name},
            {id: sg.word.verb.id, value: sg.word.verb.name},
            {id: sg.word.adverb.id, value: sg.word.adverb.name},
            {id: sg.word.adjective.id, value: sg.word.adjective.name}
        ],
        on: {
            onAfterTabClick: function(id, event) {
                console.log("on after");
            },
            onBeforeTabClick: function(id, event) {
            },
            onChange: function(newValue, oldValue) {
                var wordInputTitle = $$("word_input_title");
                var $wordInputTitle = jQuery("div[view_id='word_input_form']");
                $wordInputTitle.removeClass(oldValue).addClass(newValue);
                if (newValue == sg.word.noun.id) {
                    wordInputTitle.setValue(sg.word.noun.name);
                } else if (newValue == sg.word.verb.id) {
                    wordInputTitle.setValue(sg.word.verb.name);
                } else if (newValue == sg.word.adverb.id) {
                    wordInputTitle.setValue(sg.word.adverb.name);
                } else if (newValue == sg.word.adjective.id) {
                    wordInputTitle.setValue(sg.word.adjective.name);
                }
            }
        }
    };

    var nounDataTable = makeWordDataTable(sg.word.noun.id);
    var verbDataTable = makeWordDataTable(sg.word.verb.id);
    var adverbDataTable = makeWordDataTable(sg.word.adverb.id);
    var adjectiveDataTable = makeWordDataTable(sg.word.adjective.id);

    var wordLists = {
        cells:[
            nounDataTable,
            verbDataTable,
            adverbDataTable,
            adjectiveDataTable
        ]
    };

    var favoriteMenu = {
        id: "side_menu", view: "menu", layout: "y", select:true, width: 200, data: [
            {id: 1, icon: "support", value: "♥ 이름별 보기", badge: "12"},
            {id: 2, icon: "support", value: "★ 평가별 보기", badge: "27"}
        ],
        on: {
            onMenuItemClick: function (id) {
                console.log(id);
            }
        }
    };
    var generateMenu = {
        id: "side_menu", view: "menu", layout: "y", select:true, width: 200, data: [
            {id: 1, icon: "support", value: "문장생성", badge: "12"}
        ],
        on: {
            onMenuItemClick: function (id) {
                console.log(id);
            }
        }
    };
    var wordListMenu = {
        id: "side_menu", view: "menu", layout: "y", select: true, width: 200, data: [
            {id: 1, icon: "support", value: "시", badge: "12"},
            {id: 2, icon: "support", value: "동시", badge: "27"},
            {id: 3, icon: "support", value: "소설", badge: "99"},
            {id: 4, icon: "support", value: "수필", badge: "99"},
            {id: 5, icon: "support", value: "동화", badge: "99"},
            {id: 6, icon: "support", value: "기타", badge: "99"}
        ],
        on: {
            onMenuItemClick: function (id) {
                console.log(id);
            }
        }
    };

    var bodyLayout = {
        id:"body_layout",
        cols: [
            wordListMenu,
            {$template: "Spacer", width: 10},
            {
                rows: [
                    wordInputForm,
                    {$template: "Spacer", height: 10},
                    wordListTabBar,
                    wordLists
                ]
            }
        ]
    };

    webix.ui({
        type:"wide", css:"main_container", cols:[
            {
                type: "space", width:960, rows: [
                    topToolbar,
                    bodyLayout
                ]
            }
        ]
    });

    $$("side_menu").select(1);
    $$("word_input_title").setValue(sg.word.noun.name);
</script>
</body>
</html>