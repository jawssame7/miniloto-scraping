require("./bootstrap");

var numbers = [];

for (var i = 0; i < 31; i++) {
  var ret = i < 9 ? "0" + (i + 1) : "" + (i + 1);
  ret = '<span class="forecast">' + ret + "</span>";
  numbers.push(ret);
}

var tableRowTpl = [
  '<tr class="forecast-row">',
  '<td class="times align-left">',
  "予想",
  "</td>",
  '<td class="lottery-date align-left">',
  "",
  "</td>",
  '<td class="number-area ">',
  "<div>",
  numbers.join(""),
  "</div>",
  "</td>",
  '<td class="bonus-number">',
  '<div class="ui button mini row-hide">',
  "非表示",
  "</div>",
  "</td>",
  "</tr>",
];

$(function () {
  // 行追加ボタン
  $("button.add-row").click(function () {
    var me = this,
      $result = $("table.result"),
      $tbody = $result.find("tbody"),
      $resultRow = $($tbody.find("tr.result-row")[0]),
      $resultTimes = $($resultRow.find("td.times")),
      $resultLotteryDate = $($resultRow.find("td.lottery-date")),
      tableRow = $.extend([], tableRowTpl),
      time;

    time = getTimeNum($resultTimes.text()) + 1;
    tableRow[2] = "第" + time + "回 " + tableRow[2];
    tableRow[5] = nextLotteryDate($resultLotteryDate.text());
    $tbody.prepend(tableRow.join(""));
  });

  // 予想数字クリック（選択した数字の色を変える）
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
    }
  });

  // 予想行非表示
  $(document).on("click", "td div.row-hide", function (e) {
    console.log("aaaaaaaaaaa");
    var $target = $(e.target),
      $tr = $target.parents("tr");
    $tr.hide();
  });

  // 予想行をすべて表示
  $(".all-display").click(function () {
    var $result = $("table.result"),
      forecastTrs = $result.find("tr.forecast-row");

    $.each(forecastTrs, function (i, el) {
      $el = $(el);
      $el.show();
    });
  });

  // 予想を追加
  $(".add-forecast").click(function () {
    var $modal = $(".forecast-add-confirm"),
      $result = $("table.result"),
      forecastTrs = $result.find("tr.forecast-row"),
      results = [];

    $modal
      .modal({
        onApprove: function () {
          // 予想を登録
          submitMiniLotoForecast(forecastTrs);
        },
      })
      .modal("show");
  });
});

/**
 * 「第xxxx回」という文字列からxxxxを抜き出し数値型に変換
 * @param {String} target
 * @returns
 */
function getTimeNum(target) {
  var prefix = "第",
    suffix = "回";

  return parseInt(
    target.substr(target.indexOf(prefix) + 1, target.lastIndexOf(suffix) - 1)
  );
}

function parseLotteryDate(target) {
  var yearText = "年",
    monthText = "月",
    dayText = "日",
    day;

  target = target.replace(yearText, "/");
  target = target.replace(monthText, "/");
  target = target.replace(dayText, "");

  day = new Date(target);

  return day;
}

/**
 * 次の抽選日を返す
 * @param {String} target
 * @returns
 */
function nextLotteryDate(target) {
  var date = parseLotteryDate(target);

  if (!isNaN(date.getTime())) {
    date.setDate(date.getDate() + 7);
  } else {
    date = new Date();
  }

  return (
    date.getFullYear() +
    "年" +
    (date.getMonth() + 1) +
    "月" +
    date.getDate() +
    "日"
  );
}

function submitMiniLotoForecast(forecastTrs) {
  var data = [];
  $.each(forecastTrs, function (i, el) {
    var $el = $(el),
      times = $el.find("td.times").text(),
      lotteryDate = $el.find("td.lottery-date").text(),
      perNumbers = [],
      $perNumbers;

    $perNumbers = $el.find("span.forecast.forecast-color");

    $.each($perNumbers, function (i, perNumEl) {
      $perNumEl = $(perNumEl);
      perNumbers.push($perNumEl.text());
    });

    console.log(times, lotteryDate, perNumbers);

    data.push({
      times: times,
      lotteryDate: lotteryDate,
      perNumbers: perNumbers.join(","),
    });
  });

  // データ登録
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: "./miniloto/forecast",
    method: "post",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify(data),
  }).done(function (res) {
    console.log(res);
    if (res.success) {
      $(".success-modal")
        .modal({
          onApprove: function () {
            location.reload();
          },
        })
        .modal("show");
    } else {
      $(".failure-modal")
        .modal({
          onApprove: function () {
            location.reload();
          },
        })
        .modal("show");
    }
  });
}
