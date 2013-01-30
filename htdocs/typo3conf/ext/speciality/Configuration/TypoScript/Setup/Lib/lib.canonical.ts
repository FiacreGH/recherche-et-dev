###################################################
# lib.canonical
###################################################

lib.canonical = TEXT
lib.canonical {
     typolink {
          parameter = # value defined in condition
          useCacheHash = 1

          # add all get parameters from the current URL
          addQueryString = 1
          addQueryString.method = GET

          # remove the page id from the parameters so it is not inserted twice
          addQueryString.exclude = id
          returnLast = url
     }
     wrap = <link rel="canonical" href="http://{config.domain}/|" />
}

# Defines the page uid + the parameter name to build up the canonical URL
#[globalVar = GP:tx_displaycontroller|media > 0]
#     page.headerData.1343131161 < lib.canonical
#     page.headerData.1343131161.typolink.parameter = 139
#[global]
