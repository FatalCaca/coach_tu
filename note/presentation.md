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
## un bout de code fait ce qu'on lui demande
## la feature terminée fait ce qu'on lui demande
## la feature fait **toujours** ce qu'on lui avait demandé

N'importe quel dev teste déjà presque tout ce qu'il fait. L'argumentaire principale pour défendre le test peut en général se résumer comme suit : il faut vérifier que ça fonctionne avant de livrer.
On peut quand même différencier trois types de test :
- celui qui vérifie, pendant le dev, qu'on est sur la bonne voie. Il valide des petits bouts de code
- celui qui, une fois la feature développée, vérifie qu'elle fait bien ce qu'on attendait d'elle

---
# Tester manuellement des bouts de code :
## on rend le programme verbeux (echo, dump ...)
## on check les choses dumpée
## on **enlève** les echo/etc. inutiles quand on a fini

---
# Tester manuellement une features terminée :
## on joue un ou deux scénarios
## à chaque modification on rejoue au moins un scénario
## un peu long

---
# Tester qu'une ancienne feature n'a pas été cassée :
## on joue le plus de scénarios possibles
## nécessite de replacer dans le contexte de la feature
## vraiment long

---
# Conclusion
## efficace
## long
## vraiment très **long**

---
# Tester automatiquement
## **Écrire un programme qui teste un programme**

---
# Exemple
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

---
# Exemple
## facile à utiliser
## va devenir compliqué à maintenir
## obtenir des stats sur le % de tests échoués ?
## obtenir plus de détails ?

---
# xUnit
## 
