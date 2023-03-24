(function($) {

  $.fn.simplemde = function() {

    return this.each(function() {
    	
    	var simplemde = $(this);
    	
    	// Abort mission when field is readonly
    	if (simplemde.attr("readonly")) {
    		simplemde.autosize();
    		return;
    	}
    	    	
    	var field = simplemde.closest(".field");
    	var indexUrl = simplemde.data("json") + '/index.json';
    	var translationUrl = simplemde.data("json") + '/translation.json';
    	
    	if(field.data('editor')) {
    	  return $(this);
    	}
    	
    	// Translation
    	$.ajax({
    	  url: translationUrl,
    	  dataType: 'json',
    	  success: function(translation) {
    	    // Buttons
    	    $(".field-with-simplemde").find(".editor-toolbar-inner a").each(function() {
    	    	var title = $(this).attr("title").replace(/[{}]/g, "");
    	    	if (translation[title]) {
    	    	  $(this).attr("title", translation[title]);
    	    	}
    	    });
    	    // Pagelink
    	    $(".field-with-simplemde").find(".editor-toolbar").data("pagelink-placeholder", translation["pagelink.placeholder"] + "...");
    	    $(".field-with-simplemde").find(".editor-toolbar").data("no-results", translation["pagelink.no-results"]);
    	  }
    	});
    	
    	var buttons = [
    	  "heading-2",
    	  "heading-3",
    	  "bold",
    	  "italic",
    	  "unordered-list",
    	  "ordered-list",
    	  "link",
    	  "pagelink",
    	  "email"
    	];
    	
    	if (simplemde.data("buttons")) {
        var setButtons = simplemde.data("buttons");
        if (setButtons == "no") {
          buttons = [];
        }
        else {
          setButtons = setButtons.replace("h1", "heading-1");
          setButtons = setButtons.replace("h2", "heading-2");
          setButtons = setButtons.replace("h3", "heading-3");
          buttons = setButtons.split(" ");
        }
    	}
    	
    	var toolbarItems = [
    		{
    			name: "heading-1",
    			action: SimpleMDE.toggleHeading1,
    			className: "fa fa-header fa-header-x fa-header-1",
    			title: "{{button.h1}}",
    		},
    		{
    			name: "heading-2",
    			action: SimpleMDE.toggleHeading2,
    			className: "fa fa-header fa-header-x fa-header-2",
    			title: "{{button.h2}}",
    		},
    		{
    			name: "heading-3",
    			action: SimpleMDE.toggleHeading3,
    			className: "fa fa-header fa-header-x fa-header-3",
    			title: "{{button.h3}}",
    		},
    		{
    			name: "bold",
    			action: SimpleMDE.toggleBold,
    			className: "fa fa-bold",
    			title: "{{button.bold}}",
    		},
    		{
    			name: "italic",
    			action: SimpleMDE.toggleItalic,
    			className: "fa fa-italic",
    			title: "{{button.italic}}",
    		},
    		{
    			name: "unordered-list",
    			action: SimpleMDE.toggleUnorderedList,
    			className: "fa fa-list-ul",
    			title: "{{button.unordered-list}}",
    		},
    		{
    			name: "ordered-list",
    			action: SimpleMDE.toggleOrderedList,
    			className: "fa fa-list-ol",
    			title: "{{button.ordered-list}}",
    		},
    		{
    			name: "quote",
    			action: SimpleMDE.toggleBlockquote,
    			className: "fa fa-quote-left",
    			title: "{{button.quote}}",
    		},
    		{
    			name: "code",
    			action: SimpleMDE.toggleCodeBlock,
    			className: "fa fa-code",
    			title: "{{button.code}}",
    		},
    		{
    			name: "horizontal-rule",
    			action: SimpleMDE.drawHorizontalRule,
    			className: "fa fa-minus",
    			title: "{{button.horizontal-rule}}",
    		},
    		{
    			name: "link",
    			action: function linkFunction(){
    				var cm = simplemde.codemirror;
    				var selection = cm.getSelection();
    	      var text = '';
    	      var link = '';
    	      if (selection.match(/^https?:\/\//)) {
    	        link = selection;
    	      } else {
    	        text = selection;
    	      }
    	      var replacement = '(link: ' + link + ' text: ' + text + ')';
    	      cm.replaceSelection(replacement);
    	      var cursorPos = cm.getCursor();
    	      if (link) {
    	          cm.setCursor(cursorPos.line, cursorPos.ch - 1);
    	      } else {
    	          cm.setCursor(cursorPos.line, cursorPos.ch - (replacement.length - 7));
    	      }
    	      cm.focus();
    			},
    			className: "fa fa-link",
    			title: "{{button.link}}",
    		},
    		{
    			name: "pagelink",
    			action: function pagelinkFunction() {    				
    				field.find(".editor-toolbar").toggleClass("pagelink-open");
    				if (field.find(".pagesearch").length) {
    				  field.find(".pagesearch").remove();
    				  return;
    				}
    				else {
    				  var input = $('<input type="text" class="pagesearch" placeholder="' + field.find(".editor-toolbar").data("pagelink-placeholder") + '">');
    				  field.find(".editor-toolbar").append(input);
    				}
    				    				
    				var index = {
    					url: function(phrase) {
  							return indexUrl + "?phrase=" + phrase;
  						},
    					getValue: "title",
          		template: {
				        type: "custom",
				        method: function(value, item) {
				          return '<span class="title">' + value + '</span>' + 
				          '<span class="uri"> (' + item.uri + ')</span>';
				        }
          		},
    					list: {
    						maxNumberOfElements: 100,
    						onChooseEvent: function() {
    							var title = input.getSelectedItemData().title;
    							var uri = input.getSelectedItemData().uri
    							
    							var cm = simplemde.codemirror;
    							var selection = cm.getSelection();
    							if (selection) {
    							  var replacement = '(link: ' + uri + ' text: ' + selection + ')';
    							}
    							else {
    							  var replacement = '(link: ' + uri + ' text: ' + title + ')';
    							}
    							cm.replaceSelection(replacement);
    							var cursorPos = cm.getCursor();
    							cm.focus();
    							
    							field.find(".editor-toolbar").removeClass("pagelink-open");
    							field.find(".editor-toolbar .easy-autocomplete").remove();
								},
								onHideListEvent: function() {
									var containerList = field.find(".easy-autocomplete-container ul");
									if ($(containerList).children('li').length <= 0) {
									  $(containerList).html('<li class="no-results">' + field.find(".editor-toolbar").data("no-results") + '</li>').show();
									}
								}
    					}
    				};
    				input.easyAutocomplete(index);
                        
            input.focus();
            
            input.on('keyup',function(evt) {
              if (evt.keyCode == 27) {
                field.find(".editor-toolbar").removeClass("pagelink-open");
                field.find(".pagesearch").remove();
                simplemde.codemirror.focus();
              }
            });
    				
    			},
    			className: "fa fa-file",
    			title: "{{button.page}}",
    		},
    		{
    			name: "email",
    			action: function emailFunction(){
    				var cm = simplemde.codemirror;
    				var selection = cm.getSelection();
    		    var text = '';
    		    var email = '';
    		    
    		    if (selection) {
    		      if (selection.match("@")) {
    		        email = selection;
    		      } else {
    		        text = selection;
    		      }
    		      var replacement = '(email: ' + email + ' text: ' + text + ')';
    		    }
    		    else {
    		      var replacement = '(email: )';
    		    }
    		    
    		    cm.replaceSelection(replacement);
    		    var cursorPos = cm.getCursor();
    		    if (email) {
    		        cm.setCursor(cursorPos.line, cursorPos.ch - 1);
    		    } else {
    		        cm.setCursor(cursorPos.line, cursorPos.ch - (replacement.length - 8));
    		    }
    		    cm.focus();
    			},
    			className: "fa fa-envelope",
    			title: "{{button.email}}",
    		}
    	];

    	toolbarItems = toolbarItems.filter(function(item) {
    		for (var i2 = 0; i2 < buttons.length; i2++) {
    			if (buttons[i2] == item.name) {
    			  return true;
    			}
    		}
      });
      
      var simplemde = new SimpleMDE({
      	element: $(this)[0],
      	spellChecker: false,
      	status: false,
      	parsingConfig: {
      		allowAtxHeaderWithoutSpace: true
      	},
      	forceSync: true,
      	toolbar: toolbarItems,
      });
      
      // Drag and Drop
      field.find('.CodeMirror').droppable({
        hoverClass: 'CodeMirror-over',
        accept: $('.sidebar .draggable'),
        drop: function(e, ui) {
          var editor = simplemde.codemirror;
          var selection = editor.getSelection();
          if(selection.length>0){
              editor.replaceSelection(ui.draggable.data('text'));
          }
          else{
              var doc = editor.getDoc();
              var cursor = doc.getCursor();
              var pos = {
                line: cursor.line,
                ch: cursor.ch
              }
              doc.replaceRange(ui.draggable.data('text'), pos);
          }
        }
      });
                  
      // Keep changes
      simplemde.codemirror.on("change", function() {
        
        // Validation
        var counter = field.find(".field-counter");
        var textarea  = counter.parent('.field').find('.input');
        var length    = $.trim(textarea.val()).length;
        var max       = textarea.data('max');
        var min       = textarea.data('min');
        length = $.trim(textarea.val()).length;
        counter.text(length + (max ? '/' + max : ''));
        if((max && length > max) || (min && length < min)) {
          counter.addClass('outside-range');
        } else {
          counter.removeClass('outside-range');
        }
        
      	field.closest('form').trigger('keep');
        
      });
      
      setTimeout(function() {
        simplemde.codemirror.refresh();
      }, 200);
      
      // Check for tabs plugin
      if ($(".tab-placeholder").length || $(".tab-container").length) {
        field.addClass("tabs-helper");
      }
            
      field.data('editor', true);
            
    });

  };

})(jQuery);