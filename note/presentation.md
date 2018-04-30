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
Une question plus intéressante c'est "pourquoi est-ce qu'on ne teste pas ?". Parce que c'est chiant et que ça prend du temps.

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
Une solution moins lourde est de chercher à automatiser les tests. L'outil principal pour automatiser des choses étant le programme, on va donc écrire des programmes pour tester notre soft principal.

## Note
Il existe des termes pour différencier les "types" de tests. En gros :
- un test "proche du code" est dit "unitaire"
- un test "proche de l'utilisateur" est dit "fonctionnel"

Entre les deux se trouvent les tests d'intégrations.
Quand on teste la capacité d'un soft à tenir la charge, on parle de test ... de charge.
Quand un test déroule un flux complet, on parle de test "de bout en bout" (end to end).
Quand un test vérifie l'ergonomie d'une interface, on parle de test d'accessibilité.
etc.

Il existe une floppée de mots plus ou moins précis pour décrite tel ou tel méthode/contexte/moyens mise en œuvre pour tester.
Dans le contexte de ce document, peu de rigueur sera accordée à ces termes. La seul distinction qui nous interesse est de savoir si un test est manuel ou automatique.

---
# Premier essai
```php
// Code à tester :

function addition($a, $b)
{
    return $a + $b;
}
```

```php
// Code qui teste :

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
```

Essayons donc une ébauche d'un programme qui n'aurait pour seul but que de tester un autre programme.

---
# Exemple
## facile à utiliser
## va devenir compliqué à maintenir
## obtenir des stats sur le % de tests échoués ?
## obtenir plus de détails ?

---
# xUnit
## 
