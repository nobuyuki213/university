var changeDay = function() {
    var result    = false,
        formId    = 'change-day', // フォームのID名
        yearName  = 'birth_year',       // 年セレクトボックスのname属性値
        monthName = 'birth_month',      // 月セレクトボックスのname属性値
        dayName   = 'birth_day',        // 日セレクトボックスのname属性値
        formObj   = document.getElementById(formId);
 
    if (formObj) {
        var yearObj  = formObj[yearName],
            monthObj = formObj[monthName],
            dayObj   = formObj[dayName],
            selectY  = yearObj.options[yearObj.selectedIndex].value,
            selectM  = monthObj.options[monthObj.selectedIndex].value,
            selectD  = dayObj.options[dayObj.selectedIndex].value,
            dateObj  = new Date(selectY, selectM, 0),
            maxDays  = dateObj.getDate();
 
        dayObj.length = 0;
 
        for (var i = 1; i <= maxDays; i++) {
            dayObj.options[i] = new Option(i, i);
        }
 
        dayObj.removeChild(dayObj.options[0]);
 
        if (selectD > dayObj.length) {
            dayObj.options[dayObj.length - 1].selected = true;
        } else {
            dayObj.options[selectD - 1].selected = true;
        }
 
        result = true;
    }
    return result;
};