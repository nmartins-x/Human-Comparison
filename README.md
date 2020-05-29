# Human Comparison

A complementary algorithm to PHP's native function [`similar_text()`](https://www.php.net/manual/en/function.similar-text.php) .

It calculates the similarity between two strings with a more human approach trying to emulate how a normal person would interpret and compare two strings of text. Returns the percentage value of the similarity.

# Comparison with different algorithms

Loss of insignificant words: "loans and accounts" and "loans accounts"
```
human_comparison(): 		89.6%
similar_text(): 		87.5%
Levenshtein:			78%
Smith-Waterman Gotoh:	  89%
Jaro Winkler:			93%
```

Small changes: "loans and accounts" and "loan and account"
```
human_comparison(): 		93.3%
similar_text(): 		94.1%
Levenshtein:			89%
Smith-Waterman Gotoh:	  94%
Jaro Winkler:			98%
```

Rearrangment of words: "loans and accounts" and "accounts and loans"
```
human_comparison(): 		50%
similar_text(): 		44.4%
Levenshtein:			44%
Smith-Waterman Gotoh:	  47%
Jaro Winkler:			0%
```

Punctuation: "fishing, "camping"; and 'forest$" and "fishing camping and forest".
```
human_comparison(): 		100%
similar_text(): 		85.2%
Levenshtein:			84%
Smith-Waterman Gotoh:	  84%
Jaro Winkler:			97%
```

Spacing: "LoanAccountDealing" "Load, Account, Dealing".
```
human_comparison(): 		94.4%
similar_text(): 		85%
Levenshtein:			77%
Smith-Waterman Gotoh:	  78%
Jaro Winkler:			91%
```

Test: "Harry Potter" and "Potter Harry". Try
```
human_comparison(): 		54.5%
similar_text(): 		50%
Levenshtein:			0%
Smith-Waterman Gotoh:	  50%
Jaro Winkler:			0%
```
