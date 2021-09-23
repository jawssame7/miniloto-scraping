require("./bootstrap");

var numbers = [];

for (var i = 0; i < 31; i++) {
  var ret = i < 9 ? "0" + (i + 1) : "" + (i + 1);
  ret = '<span class="forecast">' + ret + "</span>";
  numbers.push(ret);
}

var tableRowTpl = [
  '<tr class="">',
  '<td class="times align-left">予想',
  "</td>",
  '<td class="lottery-date align-left">',
  "</td>",
  '<td class="number-area ">',
  "<div>",
  numbers.join(""),
  "</div>",
  "</td>",
  '<td class="bonus-number"></td>',
  "</tr>",
].join("");

$(function () {
  // 行追加ボタン
  $("button.add-row").click(function () {
    console.log("aaaaaaaaaa");
    var $result = $("table.result"),
      $tbody = $result.find("tbody");
    console.log($result);
    $tbody.prepend(tableRowTpl);
  });

  //

  $(document).on("click", "td", function (e) {
    var colorCls = "forecast-color",
      $target = $(e.target),
      cls = $target.attr("class");

    if (cls.indexOf("forecast") > -1) {
      if (cls.indexOf(colorCls) > -1) {
        $target.removeClass(colorCls);
      } else {
        $target.addClass(colorCls);
      }
    } else {
    }
  });

  //   $("span.forecast").click(function () {
  //     var $el = $(this),
  //       cls = $el.attr("class");
  //     debugger;
  //     //
  //     if ("forecast".indexOf(cls) > -1) {
  //       $el.addClass("forecast");
  //     } else {
  //       $el.removeClass("forecast");
  //     }
  //   });
});
