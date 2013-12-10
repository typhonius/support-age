
setInterval(function() {
  var o = 0;
  $('.duration meta[itemprop="unix"]').each( function(event) {
    var a = $(this).attr("content") * 1000;
    o += (new Date().getTime() - a);
    var t = countdown(a, null, countdown.DEFAULTS).toString();
    $(this).siblings('span.age').html(t);
  });
  $('.totalskillz span').html(countdown(0, o, countdown.DEFAULTS).toString());
}, 1000);
