# Neos CMS cache management backend module

A package with which you can manage the Neos CMS caches.

## Installation

The NeosRulez.CacheManager package is listed on packagist (https://packagist.org/packages/neosrulez/cachemanager) - therefore you don't have to include the package in your "repositories" entry any more.

Just run:

```
composer require neosrulez/cachemanager
```

## Configuration

```yaml
NeosRulez:
  CacheManager:
    caches:
      Neos_Fusion_Content:
        label: 'Neos Content'
      Flow_Mvc_Routing_Route:
        label: 'Routes (Matching)'
      Flow_Mvc_Routing_Resolve:
        label: 'Routes (Resolving)'
```

## 🙈 Shameful information

This package was largely copied from `flownative/neos-cachemanagement`. Fusion was used for the templates and Neos 7 compatibility was established.


## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com
