# Notes
un tu n'est jamais rien d'autre qu'un programme qui teste un bout d'un autre programme
souvent, après un ticket, on pète des trucs
il faut faire en sorte de ne pas push des trucs pété : ça représente une perte de temps (et d'énergie) pour le client/po et le dev (retours qui reviennent après; etc.)
on peut tester tout, manuellement, avant de push
mais c'est pénible

Il faut chercher à automatiser

Première étape pour un test : le faire échouer. Toujours s'assurer que le bug est bien présent

Les tests que vous écrivez ne sont pas pour vous

Les tests permettent de se lancer dans des grosses refacto sans avoir à retester toute l'application
Ils augmentent la confiance dans le code

---
# Pourquoi tester ?
# Pour vérifier que :
## un **bout de code** fait ce qu'on lui demande
## la **feature terminée** fait ce qu'on lui demande
## **l'ancienne feature** fait toujours ce qu'on lui avait demandé

N'importe quel dev teste déjà presque tout ce qu'il réalise. Au moment où il le réalise, en tous cas. Le test n'a toujours qu'un seul but : **vérifier que ça marche**
On peut différencier trois types de test :
- celui qui vérifie, pendant le dev, qu'on est sur la bonne voie. Il valide des petits bouts de code
- celui qui, une fois la feature développée, vérifie qu'elle fait bien ce qu'on attendait d'elle
- celui qui, une fois **une autre** feature développée, vérifie que **l'ancienne** feature fait toujours ce qu'elle devait faire (non régression)

La question "pourquoi tester" n'est en réalité pas très utile. C'est évident qu'il faut tester, qu'il faut que le code livré fonctionne.
Une question plus intéressante c'est "pourquoi est-ce qu'on ne teste pas ?". Parce que c'est chiant et que ça prend du temps. Pourquoi ? Quoi faire pour que ça le soit moins ?

---
# Tester manuellement des bouts de code :
## on rend le programme verbeux (echo, dump ...)
## on check les choses dumpée
## on **enlève** les echo/etc. inutiles quand on a fini

Tester pendant le developpement est assez naturel. On mets des `echo()` pour constater en temps réel les modifications qu'on fait dans le code. Une fois qu'on a le résultat désiré, on les enlève. Si on a un debugger sous la main on peut regarder avec des points d'arrêt (par exemple).
Même si c'est assez naturel, il faut quand même noter que toute l'énergie mise dans le test ne laisse aucune trace. Si je reviens sur mon code d'il y a un mois il faut que je remette mes `echo()` un peu partout. Pire, il faut que je **retrouve** où les mettre. Il faut aussi que je retrouve ce qu'ils sont supposés m'afficher.
En plus de ça, certains objets/fonctions sont assez pénible à examiner. Il faut parfois dev des fonctions pour rendre dumpables certains objets. Tout ce taf est également supprimé lorsqu'on estime avoir terminé une feature.
Aucune trace de ces tests ne restent dans l'historique du projet, donc.

Même si il s'agit de tests moyennement contraignants, ils sont nécessaires pour réaliser la plupart des features (sauf les toutes petites). En général, donc, personne ne rechigne à les faire. On a un code qui est :
1 en cours de construction
2 fini mais "sale" (en cours de test)
3 fini et propre, avec les artefacts de test supprimés

---
# Tester manuellement une features terminée :
## on joue un ou deux scénarios
## à chaque modification on rejoue au moins un scénario
## un peu long

C'est le test qu'on fait avant de livrer. Souvent assez sérieusement à la première livraison, puis de manière de plus en plus rapide.
Plus on a à le réaliser, plus cela devient pénible :
- il faut des **jeux de données** préalables pour pouvoir dérouler un flux avec la feature. Il faut donc **préparer** ces jeux.
- il faut ensuite controller tous les **résultats** de la feature.
- enfin, il **faudrait** aussi controller le **comportement interne** de la feature. Généralement, quand les indicateurs que nous avons évoqués plus haut ont sautés (les `echo()`), on laisse cette partie de coté (et ça n'est pas que de la flemme : ça prendrait effectivement trop de temps de remettre tous les indicateurs, de controller, puis de les enlever)

Pour ces raison, le test "avant livraison" a tendance à être de plus en plus rapide au fur et à mesure. Surtout lorsqu'il ne s'agit que d'un petit bugfix (peu de chance d'avoir cassé quelque chose) ou qu'un bon test demande trop de manipulations.

---
# Tester qu'une ancienne feature n'a pas été cassée :
## on joue le plus de scénarios possibles
## nécessite de replacer dans le contexte de la feature
## vraiment long

C'est celui que le dev ne fait presque jamais. Il n'y que le chef de projet fonctionnel (stressé) qui le fait.
Si on le met souvent de coté c'est parce qu'il est particulièrement pénible à mettre en place. Il faut rejouer des scénario sur chacune des features potentiellement impactées. Plusieurs (gros) problèmes :
- il faut être capable de déterminer les features impactées. C'est difficile et, en plus de ça, on casse souvent **plus loin** que ce qu'on aurait pu estimer
- il faut connaître les features. C'est un point qui peut paraître anodin mais dans beaucoup de gros projet, la plupart des dev ne connaissent pas la plupart des features
- il faut pouvoir préparer des jeux de données pour toutes les features. C'est sans doute le point le plus pénible

Plus un soft grossit, plus c'est difficile de se prévenir contre les régressions. Ça n'est pas un problème de qualité de code ou de compétence de l'équipe technique. N'importe quel projet a une masse critique à partir de laquelle il n'est plus rentable de chercher à tout tester.
C'est là que les gros ennuis commencent.

---
# Conclusion
## efficace
## long
## vraiment très **long**

Nous avons passé en revue les différentes manières de tester manuellement. Ou plutôt leurs inconvénients. Les raisons pour lesquelles on les met de coté.
Les tests manuels sont efficaces. Ce sont même les meilleurs moyens pour déceller des bugs, pour peu que le testeur y mette de la volonté et un peu de rigeur.
Pourquoi donc les mettre de coté ? Parce qu'ils sont pénibles et sont très rapidement impraticables.

---
# Tester automatiquement
## **Écrire un programme qui teste un programme**

Une solution consiste à engager des gens uniquement pour tester un soft. Les (très) gros soft − ou ceux particulièrement critiques − ont presque tous leur équipe de testeurs dédiée.
Une autre solution, moins lourde, est de chercher à automatiser les tests. L'outil principal pour automatiser n'importe quoi étant le programme, on va donc écrire des programmes pour tester notre soft principal.

## Note
Il existe des termes pour différencier les "types" de tests.
- Les tests les plus "proches du code" sont dits "unitaires"
- Les tests les plus "proches de l'utilisateur" sont généralement dits "fonctionnel"
- Entre les deux on trouve les tests d'intégrations
- Quand on teste la capacité d'un soft à tenir la charge, on parle de test ... de charge
- Quand un test déroule un flux complet, on parle de test "e bout en bout" (end to end)
- Quand un test vérifie l'ergonomie d'une interface, on parle de test d'accessibilité
- etc.

Il existe une floppée de mots plus ou moins précis pour décrite tel ou tel méthode/contexte/moyens mise en œuvre pour tester.
Dans ce document, peu de rigueur sera accordée à ces termes. La seul distinction qui nous interesse est de savoir si un test est manuel ou automatique. Presque tous les tests pouvant être automatisés, tout ce dont on parlera sera entendu comme "automatique" par défaut (à moins qu'on ne précise "manuel").

---
# Premier essai
```php
// addition.php
// Code à tester :

function addition($a, $b)
{
    return $a + $b;
}
```

```php
// testAddition.php
// Code qui teste :

require('addition.php');

function testAddition()
{
    if (addition(2, 2) !== 4) {
        echo("Erreur ! addition fonctionne mal avec 2 et 2");
    }

    if (addition(10, 23) !== 32) {
        echo("Erreur ! addition fonctionne mal avec 10 et 23");
    }

    if (addition(-10, 4) !== -6) {
        echo("Erreur ! addition fonctionne mal avec -10 et 4");
    }

    echo("Ok !");
}

testAddition();
```

Essayons donc une ébauche d'un programme qui n'aurait pour seul but que de tester un autre programme.

---
# Exemple
## facile à utiliser
## va devenir compliqué à maintenir
## obtenir des stats sur le % de tests échoués ?
## obtenir plus de détails ?

Pour utiliser notre test, on a qu'à lancer `php testAddition.php` et à regarder le résultat. C'est simple et rapide.
C'est **très** important que les tests puissent être lancés facilement. C'est ce qui nous permet de vérifier très souvent que notre code fonctionne. À chaque modification on peut savoir si quelque chose coince, et où ça coince. C'est un premier pas vers l'intégration continue.
En réalité, l'exécution des test doit même **rythmer** l'écriture du code. Les tests doivent servir à **remplacer** les indicateur `echo()` dont nous avons parlé plus haut. Ce sont eux qui doivent devenir les "yeux" qui permettent de controller l'exécution d'une feature. À la différence des `echo()`, les tests peuvent (et doivent) rester dans le projet. Nous en reparlerons plus tard avec un exemple.

Malgré cette facilité d'utilisation on sent que notre outil de test va rapidement devenir compliqué à faire évoluer. Il va falloir factoriser l'affichage des message, gérer les différentes conditions de vérifications de conformité, trouver un moyen de factoriser la pelletée de `if`, etc.
Et puis ça serait intéressant d'avoir plus de détails sur une exécution. Quel test a échoué ? Quelle méthode ? Quelle ligne ? Test échoué ou erreur d'exécution ?

Est-ce que c'est intéressant de se lancer dans l'écriture de fonctions de tests plus poussées ?

note : pour les sceptiques, j'ai laissé en annexe un exemple de TU simple sur une fonction aussi "simple" que l'addition mais beaucoup moins évidente à controler.

---
# xUnit
## dispo dans tous les langages
## simple d'utilisation
## très pratique

En réalité on en développe jamais des outils poussés pour nos tests. Et à raison. L'immense majorité des langage dispose d'un (ou plusieurs) framework de test dédiés à cela. Par exemple : jUnit, cUnit, nUnit, pyUnit, phpUnit, etc. On parle généralement de framework "xUnit".
Leurs avantages :
- une exécution aussi simple que `php testAddition.php`
- rapport de test plus complet et plus lisible
- scalent beaucoup mieux que les bricolages à la mano comme on a pu faire tout à l'heure

C'est phpUnit qui nous servira ici.

---
# phpUnit : fonctionnement global
## suite de test
## exécution des tests
## rapport

Je vais juste présenter les **concepts** utilisés par xUnit et je n'irai pas dans les détails de fonctionnement. La doc de ces framework et généralement très détaillée et les infos ne manquent pas sur le net.

Une suite de test est en ensemble de tests qui seront lancés les uns à la suite des autres. Une suite se définit avec une liste de fichiers à lancer ou avec un ensemble de conditions qui permettent de sélectionner les fichiers désirés (par exemple la suite "test des controller" défini avec les conditions "le fichier contient 'controller' et 'test')
Généralement on a une suite de test par défault qui permet de tout lancer. C'est celle qui nous permet de tout check après une modif. Si phpunit a un fichier de configuration bien écrit, on peut tout lancer simplement avec la commande `phpunit` pour peu que l'on soit dans le dossier racine du projet. Le phpunit.xml fourni avec la distribution de base de symfony, par exemple, permet de lancer toutes les classes qui sont dans le dossier `tests` dont le nom commence par "test".

Quand on lance un test (ou une suite entière), phpUnit se charge de faire tourner tout le code de test en :
- attrapant les exceptions si il y en a (ça fera partie du rapport)
- enregistrant les retours des tests (réussi/échoué)

Une fois tout terminé, il nous affiche le rapport. Ce qui nous intéresse dans le rapport :
- est-ce que quelque chose a merdé ?
- où ?

---
# phpUnit : anatomie d'un test
## test
## assertion
## `setUp()` et `tearDown()`

Il y a trois choses de base qui doivent être détaillées à propos des tests dans phpUnit (et qu'on retrouve partout)

Le premier c'est le test en lui-même. C'est une méthode. La classe qui les contient les tests est appellée "test case" (cas de test). On les préfixe (ou suffixe) très souvent avec "test". D'ailleur les conditions de sélection des suites de test ignorent généralement les méthodes qui n'ont pas "test" dans leur nom.
Notre classe de test (cas de test - test case) héritera systématiquement de la classe de test de base fournie par phpUnit (`PHPUnit\Framework\TestCase`). C'est ce qui nous permettra d'accéder à une grande partie de l'API de phpUnit.

L'exécution du test, ça n'est rien d'autre que l'éxécution de la méthode. On peut en principe faire tout ce qu'on pourrait faire dans un programme normal.
**Normalement**, un test ne doit tester qu'une petite partie du code. Un test ne devrait controller qu'une seule méthode, un test case ne devrait controller qu'une seule classe. Dans les faits il est souvent utile de déroger à cette règle. C'est parfois très pratique d'avoir un test qui manipule plusieurs classes et qui est donc ainsi très sensible à l'erreur : si un seul des maillons de la chaine des événement déconne, le test échoue. C'est un peu plus long de trouver la source du problème mais le test est relativement rapide à écrire et il couvre une grande partie du code.
Dans tous les cas, le but d'un test est de faire des **assertions**

Une assertion c'est une affirmation. Ce sont des choses que l'on va affirmer dans le test, et que phpUnit va vérifier. Par exemple `assertEquals($a, $b)` revient à affirmer que `$a` est égal à `$b`.
Si une assertion se révèle fausse (`$a` est différent de `$b`), alors phpUnit considère que le test a échoué. L'assertion doit représenter le comportement attendu du programme. Si elle se tromppe, c'est que le programme est erroné.
Toutes les méthodes d'assertions se trouve dans la classe dont vont hériter tous nos tests (`PHPUnit\Framework\TestCase`), on fait donc nos assertions avec `$this->assert...()`.

Il nous reste 2 méthodes à aborder à propos des bases de phpUnit : `setUp()` (initialiser) et `tearDown()` (détruire)
Pour un cas de test donné, il y a souvent des ressources dont on a besoin dans plusieurs (voir tous) les tests du cas de test. L'idéal est de factoriser l'initialisation/récupération de ces ressources et de les mettre dans le scope de l'objet pour les avoir à disposition dans tous les tests. Cependant, pas besoin de le faire manuellement : phpUnit propose déjà une solution à ce problème récurrent. La méthode `setUp()`, si elle est implémentée, sera appellée avant chaque lancement de test. La méthode `tearDown()`, quand à elle, le sera à chaque fin de test.
Dans `setUp()` on mettra tout ce qui nécessite d'être instancié/récupéré. Dans `tearDown()` tout ce qui prend des resources ou qui nécessite une remise à zéro pour chaque test.

Un petit exemple commenté pour y voir plus clair :
```php
// Toujours dans un namespace à part du code de production
namespace Tests;

// On peut importer ce qu'on veut de l'application prod
use AppBundle\Entity\User;

// La classe de base qui contient toutes les méthodes phpUnit utiles
use PHPUnit\Framework\TestCase;

// Notre cas de test
// Note : On peut la garnir avec des annotations qui indiquent diverses configurations
class UserTest extends TestCase
{

}
```

TODO : exemple avec les TU qui servent à check l'exécution d'une feature
TODO : exemple de TU pour factorielle
