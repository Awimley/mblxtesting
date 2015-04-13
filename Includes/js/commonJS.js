var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substrRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push({
                    value: str
                });
            }
        });
        cb(matches);
    };
};

function jsSafe(stringToFix) {
    var name_noSingleQuotes = stringToFix.replace(/'/mg, "\\'");
    var name_jsSafe = name_noSingleQuotes.replace(/"/mg, '\\"');
    return name_jsSafe;
}

function stripQuotesAndWhitespace(stringToFix) {
    var noSingleQuotes = stringToFix.replace(/'/mg, "");
    var noDoubleQuotesEither = noSingleQuotes.replace(/"/mg, "");
    var noWhiteSpace = noDoubleQuotesEither.replace(/\s/mg, "");
    return noWhiteSpace;
}