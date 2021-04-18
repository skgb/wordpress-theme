SKGB-Web 5
==========

SKGB-Theme für Wordpress mit dem Grafikdesign und
der Informationsarchitektur der [SKGB][], Version 5.1

Diese Software wird seit April 2021 nicht mehr durch den Autor unterstützt.
Es existiert kein Zeitplan für eine Fortführung der Entwicklung.
Die Software ist aber unter einer [freien Lizenz][] verfügbar, so
dass du sie selbst forken, verändern und weiterverwenden kannst.

Dieses Theme ist zugeschnitten auf die Wordpress-Inhalte der SKGB im
Jahr 2009. Einige Aspekte sind hardcoded, so etwa manche Artikel-IDs.
Das Theme sollte gemeinsam mit dem [SKGB–Plug-in][] verwendet werden.

[freien Lizenz]: https://github.com/skgb/wordpress-theme/blob/skgb5/LICENSE
[SKGB]: https://www.skgb.de/
[SKGB–Plug-in]: https://github.com/skgb/wordpress-plugin


Installation
------------

```sh
cd wp-content/themes
git clone https://github.com/skgb/wordpress-theme.git -b skgb5 skgb5

# Um Änderungen über die Wordpress-GUI zu ermöglichen,
# muss www-data Schreibrechte haben – zum Beispiel:
chgrp -R www-data skgb5
chmod -R g+w skgb5
```

Ein GitHub `clone` ermöglicht einfaches Aktualisieren durch `git pull`
(nach `git reset --hard`, falls nötig). Manuelle Installation ist
natürlich ebenfalls möglich, Installation über das
Wordpress-Theme-Repository jedoch nicht.


To Do
-----

Vollständige Neuentwicklung („SKGB-Web 6“);
siehe [GH issues](https://github.com/skgb/wordpress-theme/issues/)


Lizenz
------

Copyright (c) 2009 Arne Johannessen

Diese Software darf verändert und weiterverwendet werden zu den
Bedingungen der GNU General Public License – [GPL Version 2][]
oder (wahlweise) jeder neueren Version.

*Hinweis: Die GPL beschränkt nicht den Einsatz dieser Software (mit
oder ohne Änderungen) in einem Netzwerk. Die öffentliche Verwendung
des Vereinsnamens und des Stander-Logos der [SKGB][] ohne Zusammenhang
zum Verein ist jedoch unerwünscht.*

[GPL version 2]: https://github.com/skgb/wordpress-theme/blob/skgb5/LICENSE
