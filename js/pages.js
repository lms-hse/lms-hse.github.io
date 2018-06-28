/*
 * Вспомогательные функции для движка pages
 * jQuery = $j
 * 
 */

// глобальная переменная для backbone.js (модели, виды...)
window.pgApp = {
    Models: {},      // модели BB 
    Views: {},       // виды BB
    Collections: {}, // коллекции BB
    T: {},     // для перевода
    O: {}      // для объектов, например, DataTable
};

// глобальная переменная для backbone.js (вспомогательные функции)
window.pgLib = {
    template: function(id) {
        return _.template($j('#' + id).html());
    }
};

/**
 * Добавляем форматёр для строк, если его не задано
 */
if (!String.prototype.format) {
    String.prototype.format = function() {
	var formatted = this;
        for (var i = 0; i < arguments.length; i++) {
	    var regexp = new RegExp('\\{'+i+'\\}', 'gi');
    	    formatted = formatted.replace(regexp, arguments[i]);
        }
	return formatted;
    };
}

// -------
function addFilesIcons() {
    $j('.file_link').each(function() {
        href = $j(this).attr('href');
        if(href !== undefined && href.length > 4) {
            var file_type = 'fa fa-file';
            href = href.toLowerCase();
            pos = href.indexOf('.');
            pos_store = pos;
            while(pos !== -1) {
                pos = href.indexOf('.', pos + 1);
                if (pos > 0) {
                    pos_store = pos;
                }
            }
            if (pos_store > 0) {
                href_cut = href.substring(pos_store + 1);
                fileMap = { png: 'fa fa-file-image-o', 
                    jpg: 'fa fa-file-image-o',
                    pdf: 'fa fa-file-pdf-o',
                    zip: 'fa fa-file-archive-o'};
                fileClass = fileMap[href_cut];
                if (fileClass !== undefined) {
                    file_type = fileClass;
                }
            }
            $j( this ).addClass( file_type );
        }
    });
}

// Add / Update a key-value pair in the URL query parameters
function updateUrlParameter(uri, key, value) {
    // remove the hash part before operating on the uri
    var i = uri.indexOf('#');
    var hash = i === -1 ? ''  : uri.substr(i);
         uri = i === -1 ? uri : uri.substr(0, i);

    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        uri = uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        uri = uri + separator + key + "=" + value;
    }
    return uri + hash;  // finally append the hash as well
}

// удаление параметра из url если ему присвоено значение
function removeUrlParameter(uri, key) {
  // "#" может быть одна значимая (первая)
  var urlparts_hash = uri.split('#');
  var url_without_hash = uri;
  var url_hash = '';
  if (urlparts_hash.length >= 2) {
      url_without_hash = urlparts_hash.shift();
      url_hash = urlparts_hash.join("#");
  }

  // вопросов может быть больше одного
  var urlparts_q = url_without_hash.split('?');
  if (urlparts_q.length >= 2) {
      var url_base = urlparts_q.shift();
      var url_query_str = urlparts_q.join("?");
      var prefix = encodeURIComponent(key)+'=';
      var pars = url_query_str.split(/[&;]/g);
      for (var i = pars.length; i-- > 0;) {               //reverse iteration as may be destructive
          if (pars[i].lastIndexOf(prefix, 0) !== -1) {    //idiom for string.startsWith
              pars.splice(i, 1);
          }
      }
      return url_base + (pars.length > 0 ? '?' + pars.join('&') : "") + (url_hash.length > 0 ? "#" + url_hash : "");
  }
  return uri;
}

// закрытие выводимого сообщения (t=this)
function closeAlert(t) {
    var alert_div = $j(t).closest('div.content__alert');
    if(!alert_div.hasClass("alert-not-main-message")){
        window.history.pushState({ alert: "close"},"", removeUrlParameter(removeUrlParameter(window.location.href, 'message'), 'message_type'));
    }
    alert_div.hide();
}

// -------
function toCamelCase(str) {
  return str.toLowerCase()
    .replace( /[-_]+/g, ' ')
    .replace( /[^\w\s]/g, '')
    .replace( / (.)/g, function($1) { return $1.toUpperCase(); })
    .replace( / /g, '' );
}

// -------
function pgIntVal(s) {
    var p = parseInt(s);
    return isNaN(p) ? 0 : p;
};

// -------
function pgIntValDef(s, def) {
    var p = parseInt(s);
    return isNaN(p) ? def : p;
}

// -------
function pgFloatValDef(s, def) {
    var p = parseFloat(s);
    return isNaN(p) ? def : p;
}

// -------
function pgZeroTest(s) {
    return s && typeof s === 'string' && s.length > 0 && s[0] != '0' ? 1 : 0;
};

// -------
function pgEmptyTest(s) {
    return !s || (typeof s === 'string' && s.length == 0) ? 0 : 1;
};

// --------
function pgLinkAbsoluteGet(link) {
    expr = /^[http://|https://]/;
    if (expr.test(link)) {
        return link;
    } else {
        return 'http://' + link;
    }
}