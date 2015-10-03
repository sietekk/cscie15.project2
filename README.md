# CSCI E-15 Project 2
# xkcd Style Password Generator

## Live URL
<http://p2.sietekk.com>

## Description

#### Info
This [xkcd style password generator](http://xkcd.com/936/) will create a password, which is much easier to remember and much harder to hack than traditional passwords. The number of words, the type of delimiter (random if not specified), appending of a random number, and appending of a random symbol may be specified. The webpage is fully responsive using Bootstrap.

#### Validation
The [jQuery Validation Plugin](http://jqueryvalidation.org/) is implemented for client-side form validation with a custom validation scheme. Submission of the form is only allowed when integers 1-10 are entered. Further validation is handled on the server side, where default values are utilized if invalid URL parameter inputs are made on page request.

#### APIs
##### Application
The application accepts GET requests made to itself with following URL parameters and values:

| Parameter                  | Values                                                                     |
| -------------------------- | -------------------------------------------------------------------------- |
| `number of words`          | integer from `1-10` or defaults to `3` otherwise                           |
| `delimeter_choice`         | `space` or `dash` or random choice of the two otherwise                    |
| `random_number`            | `on` for appending of a random number or no appending otherwise            |
| `random_special_character` | `on` for appending of a random special character or no appending otherwise |

##### Random Words
Random words are pulled from the [Random Word API](http://randomword.setgetgo.com). The application will check if the API is accessible during loading, and will return an error if it is not.

##### API Interface
The API interface is built on a heavily customized, server side PHP script loosely based off of Leonid Svyatov's [CurlWrapper script](https://github.com/svyatov/CurlWrapper). The interface sends simple GET requests to external APIs, which return simple text responses.

## Demo
Not available at this time.

## Details for teaching team
* No login required.
* Client-side form validation is implemented with the [jQuery Validation Plugin](http://jqueryvalidation.org/)
* Random words are pulled from the [Random Word API](http://randomword.setgetgo.com).
* The API interface is built on a heavily customized, server side PHP script loosely based off of Leonid Svyatov's [CurlWrapper script](https://github.com/svyatov/CurlWrapper)

## Outside code
* jQuery: <https://jquery.com/>
* jQuery Validation Plugin: <http://jqueryvalidation.org/>
* Bootstrap: <http://getbootstrap.com/>
