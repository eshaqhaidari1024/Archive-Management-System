// Mahdi Hasheminezhad. email: hasheminezhad at gmail dot com (http://hasheminezhad.com)
jQuery(function($){
	$.datepicker.regional['ar'] = {
        calendar: HijriDate,
		closeText: 'إغلاق',
		prevText: 'السابق',
		nextText: 'التالي',
		currentText: 'اليوم',
		monthNames: ['محرّم', 'صفر', 'ربيع الأول', 'ربيع الثاني', 'جمادى الأولى', 'جمادى الآخرة', 'رجب', 'شعبان', 'رمضان', 'شوال', 'ذو القعدة', 'ذو الحجة'],
		monthNamesShort: ['محرّم', 'صفر', 'ربيع الأول', 'ربيع الثاني', 'جمادى الأولى', 'جمادى الآخرة', 'رجب', 'شعبان', 'رمضان', 'شوال', 'ذو القعدة', 'ذو الحجة'],
		dayNames: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
		dayNamesShort: ['أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
		dayNamesMin: ['أ', 'ا', 'ث', 'أ', 'خ', 'ج', 'س'],
		dateFormat: 'dd/mm/yy',
		firstDay: 6,
		isRTL: true};
	$.datepicker.setDefaults($.datepicker.regional['ar']);
});

function HijriDate(p0, p1, p2) {
    function hijri_to_gregorian(d) {
        var georgiran = jd_to_gregorian(islamic_to_jd(d[0], d[1] + 1, d[2]));
        georgiran[1]--;
        return georgiran;
    }
    function gregorian_to_hijri(d) {
        var hijri = jd_to_islamic(gregorian_to_jd(d[0], d[1] + 1, d[2]));
        hijri[1]--;
        return hijri;
    }
    var gregorianDate;
    var hijriDate;
    var isHijri = true;

    if (!p0) {
        setFullDate();
    } else if (typeof (p0) == 'boolean') {
        isHijri = p0;
        setFullDate();
    } else if (typeof (p0 == 'number')) {
        var y = parseInt(p0, 10);
        var m = parseInt(p1, 10);
        var d = parseInt(p2, 10);
        y += Math.floor(m / 12);
        m = m - Math.floor(m / 12) * 12;
        var g = hijri_to_gregorian([y, m, d]);
        setFullDate(new Date(g[0], g[1], g[2]));
    } else if (p0 instanceof Array) {
        throw new "HijriDate(Array) is not implemented yet!";
    } else {
        setFullDate(p0);
    }

    function setFullDate(date) {
        if (date instanceof HijriDate) {
            date = date.getGregorianDate();
        }
        gregorianDate = new Date(date);
        if (!gregorianDate || gregorianDate == 'Invalid Date' || isNaN(gregorianDate || !gregorianDate.getDate())) {
            gregorianDate = new Date();
        }
        hijriDate = gregorian_to_hijri([
            gregorianDate.getFullYear(),
            gregorianDate.getMonth(),
            gregorianDate.getDate()]);
        return this;
    }
    this.getGregorianDate = function() { return gregorianDate; }

    this.setFullDate = setFullDate;

    this.setDate = function(e) {
        hijriDate[2] = e;
        var g = hijri_to_gregorian(hijriDate);
        gregorianDate = new Date(g[0], g[1], g[2]);
        hijriDate = gregorian_to_hijri([g[0], g[1], g[2]]);
    };

    this.getFullYear = function() { return hijriDate[0]; };
    this.getMonth = function() { return hijriDate[1]; };
    this.getDate = function() { return hijriDate[2]; };
    this.toString = function() { return hijriDate.join(',').toString(); };
    this.getDay = function() { return gregorianDate.getDay(); };
    this.getHours = function() { return gregorianDate.getHours(); };
    this.getMinutes = function() { return gregorianDate.getMinutes(); };
    this.getSeconds = function() { return gregorianDate.getSeconds(); };
    this.getTime = function() { return gregorianDate.getTime(); };
    this.getTimeZoneOffset = function() { return gregorianDate.getTimeZoneOffset(); };
    this.getYear = function() { return hijriDate[0] % 100; };

    this.setHours = function(e) { gregorianDate.setHours(e) };
    this.setMinutes = function(e) { gregorianDate.setMinutes(e) };
    this.setSeconds = function(e) { gregorianDate.setSeconds(e) };
    this.setMilliseconds = function(e) { gregorianDate.setMilliseconds(e) };
}
