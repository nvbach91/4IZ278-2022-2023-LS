$(function () {
  $(document).on('click', '.delete-button', function (e) {
    e.preventDefault();

    if (confirm('Opravdu?')) {
      if ($(this).is('.ajax-delete')) {
        naja.makeRequest('GET', $(this).attr('href'));
      } else {
        window.location.href = $(this).attr('href');
      }
    }
  });

  $(document).on('click', '.comment-add button', function () {
    var text = $(this).closest('.comment-add').find('textarea').val();

    if (!text) {
      return;
    }

    var data = new FormData();
    data.append('text', text);

    naja.makeRequest('POST', $(this).data('href'), data);
  });

  $(document).on('click', '.reply-button', function (e) {
    e.preventDefault();

    var $textarea = $(this).closest('.comment:not(.reply)').find('textarea');

    $textarea.val(
      '@' + $(this).data('username') + ' ' + $textarea.val()
    );

    $textarea.focus();
  });

  (function () {
    var callback = function (entries) {
      if (!entries[0].isIntersecting) {
        return;
      }

      naja.makeRequest('GET', loadNextPostUrl).then(function (res) {
        if (res.loadedAll) {
          loader.remove();
        } else {
          var snippetId = Object.keys(res.snippets)[0];

          $('.posts-section').append(
            $('<div class="post" id="' + snippetId + '"></div>')
          );

          naja.snippetHandler.updateSnippets(res.snippets); //bind .ajax functionality
        }
      });
    }

    var options = {
      treshold: 0.01,
      root: null,
      rootMargin: '50px'
    };

    var loader = document.getElementById('loader');
    var loaderObserver = new IntersectionObserver(callback, options);

    loaderObserver.observe(loader);
  })();
});
