(function ($) {

    "use strict";

    function uploadFiles(url, files, editor, snippetManager, loading) {
        if (!files.length) {
            return;
        }

        if (!/.(gif|jpg|jpeg|png|gif|jpg|png)$/.test(files[0].name)) {
            $.alert('图片类型必须是.gif,jpeg,jpg,png中的一种');
            return;
        }

        loading.show();

        xn.upload_file(files[0], url, {
            is_image: 1
        }, function (code, json) {
            if (code == 0) {
                console.log(json.url);
                console.log(json.width);
                console.log(json.height);

                var separation = '';
                snippetManager.insertSnippet(editor, '![](' + json.url + ')' + separation);
                loading.hide();

            } else {
                console.log(json);
            }
        });

    }

    function adjustFullscreenLayout(mdPanel) {
        var hWindow = $(window).height(),
            tEditor = mdPanel.offset().top,
            hEditor;

        if (hWindow > tEditor) {
            hEditor = hWindow - tEditor;
            mdPanel.css('height', hEditor + 'px');
        }
    }

    function setShortcuts(editor, snippetManager) {
        editor.commands.addCommand({
            name: 'bold',
            bindKey: {
                win: 'Ctrl-B',
                mac: 'Command-B'
            },
            exec: function (editor) {
                var selectedText = editor.session.getTextRange(editor.getSelectionRange());

                if (selectedText === '') {
                    snippetManager.insertSnippet(editor, '**${1:text}**');
                } else {
                    snippetManager.insertSnippet(editor, '**' + selectedText + '**');
                }
            },
            readOnly: false
        });

        editor.commands.addCommand({
            name: 'italic',
            bindKey: {
                win: 'Ctrl-I',
                mac: 'Command-I'
            },
            exec: function (editor) {
                var selectedText = editor.session.getTextRange(editor.getSelectionRange());

                if (selectedText === '') {
                    snippetManager.insertSnippet(editor, '*${1:text}*');
                } else {
                    snippetManager.insertSnippet(editor, '*' + selectedText + '*');
                }
            },
            readOnly: false
        });

        editor.commands.addCommand({
            name: 'link',
            bindKey: {
                win: 'Ctrl-K',
                mac: 'Command-K'
            },
            exec: function (editor) {
                var selectedText = editor.session.getTextRange(editor.getSelectionRange());

                if (selectedText === '') {
                    snippetManager.insertSnippet(editor, '[${1:text}](http://$2)');
                } else {
                    snippetManager.insertSnippet(editor, '[' + selectedText + '](http://$1)');
                }
            },
            readOnly: false
        });
    }

    function insertBeforeText(editor, string) {

        if (editor.getCursorPosition().column === 0) {
            editor.navigateLineStart();
            editor.insert(string + ' ');
        } else {
            editor.navigateLineStart();
            editor.insert(string + ' ');
            editor.navigateLineEnd();
        }
    }

    function editorHtml(content, options) {
        var html = '';

        html += '<div class="md-loading"><span class="md-icon-container"><span class="md-icon"></span></span></div>';
        html += '<div class="md-toolbar">';
        html += '<div class="btn-toolbar">';

        html += '<div class="btn-group mr-2">';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnHeader1 + '" class="md-btn btn btn-sm btn-default" data-btn="h1">H1</button>';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnHeader2 + '" class="md-btn btn btn-sm btn-default" data-btn="h2">H2</button>';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnHeader3 + '" class="md-btn btn btn-sm btn-default" data-btn="h3">H3</button>';
        html += '</div>'; // .btn-group

        html += '<div class="btn-group mr-2">';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnBold + '" class="md-btn btn btn-sm btn-default" data-btn="bold"><i class="icon-bold"></i></button>';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnItalic + '" class="md-btn btn btn-sm btn-default" data-btn="italic"><i class="icon-italic"></i></button>';
        html += '</div>'; // .btn-group

        html += '<div class="btn-group mr-2">';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnList + '" class="md-btn btn btn-sm btn-default" data-btn="ul"><i class="icon-list"></i></button>';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnOrderedList + '" class="md-btn btn btn-sm btn-default" data-btn="ol"><i class="icon-list-ol"></i></button>';
        html += '</div>'; // .btn-group

        html += '<div class="btn-group mr-2">';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnLink + '" class="md-btn btn btn-sm btn-default" data-btn="link"><i class="icon-link"></i></button>';
        html += '<button type="button" data-mdtooltip="tooltip" title="' + options.label.btnImage + '" class="md-btn btn btn-sm btn-default" data-btn="image"><i class="icon-image"></i></button>';
        if (options.imageUpload === true) {
            html += '<div data-mdtooltip="tooltip" title="' + options.label.btnUpload + '" class="btn btn-sm btn-default md-btn-file"><i class="icon-upload"></i><input class="md-input-upload" type="file" accept="image/*"></div>';
        }
        html += '</div>'; // .btn-group

        if (options.fullscreen === true) {
            html += '<div class="btn-group mr-2">';
            html += '<button type="button" class="md-btn btn btn-sm btn-default" data-btn="fullscreen"><span class="glyphicon glyphicon-fullscreen"></span> ' + options.label.btnFullscreen + '</button>';
            html += '</div>'; // .btn-group
        }

        if (options.preview === true) {
            html += '<div class="btn-group">';
            html += '<button type="button" class="md-btn btn btn-sm btn-default btn-edit btn-primary" data-btn="edit"><span class="glyphicon glyphicon-pencil"></span> ' + options.label.btnEdit + '</button>';
            html += '<button type="button" class="md-btn btn btn-sm btn-default btn-preview" data-btn="preview"><span class="glyphicon glyphicon-eye-open"></span> ' + options.label.btnPreview + '</button>';
            html += '</div>'; // .btn-group
        }

        html += '</div>'; // .btn-toolbar
        html += '</div>'; // .md-toolbar

        html += '<div class="md-editor">' + $('<div>').text(content).html() + '</div>';
        html += '<div class="md-preview" style="display:none"></div>';

        return html;
    }

    var methods = {
        init: function (options) {

            var defaults = $.extend(true, {}, $.fn.markdownEditor.defaults, options),
                plugin = this,
                container,
                preview = false,
                fullscreen = false;

            // Hide the textarea
            plugin.addClass('md-textarea-hidden');

            // Create the container div after textarea
            container = $('<div/>');
            plugin.after(container);

            // Replace the content of the div with our html
            container.addClass('md-container').html(editorHtml(plugin.val(), defaults));

            // If the Bootstrap tooltip library is loaded, initialize the tooltips of the toolbar
            if (typeof $().tooltip === 'function') {
                container.find('[data-mdtooltip="tooltip"]').tooltip({
                    container: 'body'
                });
            }

            var mdEditor = container.find('.md-editor'),
                mdPreview = container.find('.md-preview'),
                mdLoading = container.find('.md-loading');

            container.css({
                width: defaults.width
            });

            mdEditor.css({
                height: defaults.height,
                fontSize: defaults.fontSize
            });

            mdPreview.css({
                height: defaults.height
            });

            // Initialize Ace
            var editor = ace.edit(mdEditor[0]),
                snippetManager;

            editor.setTheme('ace/theme/' + defaults.theme);
            editor.getSession().setMode('ace/mode/markdown');
            editor.getSession().setUseWrapMode(true);
            editor.getSession().setUseSoftTabs(defaults.softTabs);

            // Sync ace with the textarea
            editor.getSession().on('change', function () {
                plugin.val(editor.getSession().getValue());
            });

            editor.setHighlightActiveLine(false);
            editor.setShowPrintMargin(false);
            editor.renderer.setShowGutter(false);

            ace.config.loadModule('ace/ext/language_tools', function () {
                snippetManager = ace.require('ace/snippets').snippetManager;
                setShortcuts(editor, snippetManager);
            });


            // Image drag and drop and upload events
            if (defaults.imageUpload) {

                container.find('.md-input-upload').on('change', function () {
                    var files = $(this).get(0).files;

                    uploadFiles(defaults.uploadPath, files, editor, snippetManager, mdLoading);
                });

                container.on('dragenter', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                });

                container.on('dragover', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                });

                container.on('drop', function (e) {
                    e.preventDefault();
                    var files = e.originalEvent.dataTransfer.files;

                    uploadFiles(defaults.uploadPath, files, editor, snippetManager, mdLoading);
                });
            }

            // Window resize event
            if (defaults.fullscreen === true) {
                $(window).resize(function () {
                    if (fullscreen === true) {
                        if (preview === false) {
                            adjustFullscreenLayout(mdEditor);
                        } else {
                            adjustFullscreenLayout(mdPreview);
                        }
                    }
                });
            }

            // Toolbar events
            container.find('.md-btn').click(function () {
                var btnType = $(this).data('btn'),
                    selectedText = editor.session.getTextRange(editor.getSelectionRange());

                if (btnType === 'h1') {
                    insertBeforeText(editor, '#');

                } else if (btnType === 'h2') {
                    insertBeforeText(editor, '##');

                } else if (btnType === 'h3') {
                    insertBeforeText(editor, '###');

                } else if (btnType === 'ul') {
                    insertBeforeText(editor, '*');

                } else if (btnType === 'ol') {
                    insertBeforeText(editor, '1.');

                } else if (btnType === 'bold') {
                    editor.execCommand('bold');

                } else if (btnType === 'italic') {
                    editor.execCommand('italic');

                } else if (btnType === 'link') {
                    editor.execCommand('link');

                } else if (btnType === 'image') {
                    if (selectedText === '') {
                        snippetManager.insertSnippet(editor, '![${1:text}](http://$2)');
                    } else {
                        snippetManager.insertSnippet(editor, '![' + selectedText + '](http://$1)');
                    }

                } else if (btnType === 'edit') {
                    preview = false;

                    mdPreview.hide();
                    mdEditor.show();
                    container.find('.btn-edit').addClass('btn-primary');
                    container.find('.btn-preview').removeClass('btn-primary');

                    if (fullscreen === true) {
                        adjustFullscreenLayout(mdEditor);
                    }

                } else if (btnType === 'preview') {
                    preview = true;

                    mdPreview.html('<p style="text-align:center; font-size:16px">' + defaults.label.loading + '...</p>');

                    defaults.onPreview(editor.getSession().getValue(), function (content) {
                        mdPreview.html(content);
                    });

                    mdEditor.hide();
                    mdPreview.show();
                    container.find('.btn-preview').addClass('btn-primary');
                    container.find('.btn-edit').removeClass('btn-primary');

                    if (fullscreen === true) {
                        adjustFullscreenLayout(mdPreview);
                    }

                } else if (btnType === 'fullscreen') {

                    if (fullscreen === true) {
                        fullscreen = false;

                        $('body, html').removeClass('md-body-fullscreen');
                        container.removeClass('md-fullscreen');

                        mdEditor.css('height', defaults.height);
                        mdPreview.css('height', defaults.height);

                    } else {
                        fullscreen = true;

                        $('body, html').addClass('md-body-fullscreen');
                        container.addClass('md-fullscreen');

                        if (preview === false) {
                            adjustFullscreenLayout(mdEditor);
                        } else {
                            adjustFullscreenLayout(mdPreview);
                        }
                    }

                    editor.resize();
                }

                editor.focus();
            });

            return this;
        },
        content: function () {
            var editor = ace.edit(this.find('.md-editor')[0]);
            return editor.getSession().getValue();
        },
        setContent: function (str) {
            var editor = ace.edit(this.find('.md-editor')[0]);
            editor.setValue(str, 1);
        }
    };

    $.fn.markdownEditor = function (options) {

        if (methods[options]) {
            return methods[options].apply(this, Array.prototype.slice.call(arguments, 1));

        } else if (typeof options === 'object' || !options) {
            return methods.init.apply(this, arguments);

        } else {
            $.error('Method ' + options + ' does not exist on jQuery.markdownEditor');
        }
    };

    $.fn.markdownEditor.defaults = {
        width: '100%',
        height: '300px',
        fontSize: '14px',
        theme: 'tomorrow',
        softTabs: true,
        fullscreen: false,
        imageUpload: true,
        uploadPath: xn.url('attach-create'),
        preview: false,
        onPreview: function (content, callback) {
            callback(content);
        },
        label: {
            btnHeader1: 'Header 1',
            btnHeader2: 'Header 2',
            btnHeader3: 'Header 3',
            btnBold: 'Bold',
            btnItalic: 'Italic',
            btnList: 'Unordered list',
            btnOrderedList: 'Ordered list',
            btnLink: 'Link',
            btnImage: 'Insert image',
            btnUpload: 'Upload image',
            btnEdit: '编辑',
            btnPreview: '预览',
            btnFullscreen: '全屏',
            loading: '加载'
        }
    };

}(jQuery));