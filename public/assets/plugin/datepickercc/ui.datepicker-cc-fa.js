// Mahdi Hasheminezhad. email: hasheminezhad at gmail dot com (http://hasheminezhad.com)
jQuery(function($){
	$.datepicker.regional['fa'] = {
		calendar: JalaliDate,
		closeText: 'بستن',
		prevText: 'قبل',
		nextText: 'بعد',
		currentText: 'امروز',
		monthNames: ['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'],
		monthNamesShort: ['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'],
		dayNames: ['یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه', 'شنبه'],
		dayNamesShort: ['یک', 'دو', 'سه', 'چهار', 'پنج', 'جمعه', 'شنبه'],
		dayNamesMin: ['ی','د','س','چ','پ','ج','ش'],
		dateFormat: 'dd/mm/yy',
		firstDay: 6,
		isRTL: true};
	$.datepicker.setDefaults($.datepicker.regional['fa']);
});

function JalaliDate(p0, p1, p2) {
    function jalali_to_gregorian(d) {
        var georgiran = jd_to_gregorian(persian_to_jd(d[0], d[1] + 1, d[2]));
        georgiran[1]--;
        return georgiran;
    }
    function gregorian_to_jalali(d) {
        var jalali = jd_to_persian(gregorian_to_jd(d[0], d[1] + 1, d[2]));
        jalali[1]--;
        return jalali;
    }
    var gregorianDate;
    var jalaliDate;
    var isJalali = true;

    if (!p0) {
        setFullDate();
    } else if (typeof (p0) == 'boolean') {
        isJalali = p0;
        setFullDate();
    } else if (typeof (p0 == 'number')) {
        var y = parseInt(p0, 10);
        var m = parseInt(p1, 10);
        var d = parseInt(p2, 10);
        y += Math.floor(m / 12);
        m = m - Math.floor(m / 12) * 12;
        var g = jalali_to_gregorian([y, m, d]);
        setFullDate(new Date(g[0], g[1], g[2]));
    } else if (p0 instanceof Array) {
        throw new "JalaliDate(Array) is not implemented yet!";
    } else {
        setFullDate(p0);
    }

    function setFullDate(date) {
        if (date instanceof JalaliDate) {
            date = date.getGregorianDate();
        }
        gregorianDate = new Date(date);
        if (!gregorianDate || gregorianDate == 'Invalid Date' || isNaN(gregorianDate || !gregorianDate.getDate())) {
            gregorianDate = new Date();
        }
        jalaliDate = gregorian_to_jalali([
            gregorianDate.getFullYear(),
            gregorianDate.getMonth(),
            gregorianDate.getDate()]);
        return this;
    }
    this.getGregorianDate = function() { return gregorianDate; }

    this.setFullDate = setFullDate;

    this.setDate = function(e) {
        jalaliDate[2] = e;
        var g = jalali_to_gregorian(jalaliDate);
        gregorianDate = new Date(g[0], g[1], g[2]);
        jalaliDate = gregorian_to_jalali([g[0], g[1], g[2]]);
    };

    this.getFullYear = function() { return jalaliDate[0]; };
    this.getMonth = function() { return jalaliDate[1]; };
    this.getDate = function() { return jalaliDate[2]; };
    this.toString = function() { return jalaliDate.join(',').toString(); };
    this.getDay = function() { return gregorianDate.getDay(); };
    this.getHours = function() { return gregorianDate.getHours(); };
    this.getMinutes = function() { return gregorianDate.getMinutes(); };
    this.getSeconds = function() { return gregorianDate.getSeconds(); };
    this.getTime = function() { return gregorianDate.getTime(); };
    this.getTimeZoneOffset = function() { return gregorianDate.getTimeZoneOffset(); };
    this.getYear = function() { return jalaliDate[0] % 100; };

    this.setHours = function(e) { gregorianDate.setHours(e) };
    this.setMinutes = function(e) { gregorianDate.setMinutes(e) };
    this.setSeconds = function(e) { gregorianDate.setSeconds(e) };
    this.setMilliseconds = function(e) { gregorianDate.setMilliseconds(e) };
}
