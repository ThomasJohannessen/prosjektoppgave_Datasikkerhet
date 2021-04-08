<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>API dokumentasjon</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <main>
            <h1> API </h1>
            <p>Dette er siden som beskriver hvordan API-et fungerer i oppgaven vår og ikke er ment for å ha noe som helst funksjonalitet.</p>
            <p>Vi har til nå laget 4 api filer skrevet i php ettersom vi ikke forventer mer for selve student delen som appen skal behandle. Disse api filene er ment for mobilappen og sender en
            predefinert sql spørring mot database og får returnert bare det som trenges å vises i appen. Vi har også api filer med placeholders som skal for eksempel sende sql spørringer mot databasen
            dette benyttes der hvor for eksempel spørsmål skal sendes av studenten. Placeholderne vil da være input fra brukerne.</p>
            <p>Disse er de fire filene vi til nå har:</p>
            <h3>api_hentSporsmal.php</h3>
            <p>Denne henter ut alle spørsmål fra databasen som har blitt stilt av selve brukrene. Her kjøres en predefinert sql spørring og resultatet returnerer et json objekt.</p>
            <h3>api_hentSvar.php</h3>
            <p>Denne henter ut svaret på spørsmålet man har klikket seg inn på. Denne har en predefinert sql spørring som returnerer et json objekt med selve meldingen og navnet til foreleseren som har besvart spørsmålet.</p>
            <h3>api_loginBruker.php</h3>
            <p>Denne sender en predefinert spørring til databasen med burkernavn og passord oppgit av brukeren. Hvis databasen returnerer kun en rad skal brukerid returneres til brukeren som brukes
            til session cookies videre i programmet, hvis vi ikke får treff returneres en null og brukeren ikke blir innlogget.</p>
            <h3>api_sendSporsmal.php</h3>
            <p>Denne sender en sql setning til databasen som legger til en rad med brukeren sitt spørsmål. Det som fylles inn blir bestem av brukeren sin session og inputten gitt i input feltet. Ingenting skal returneres.</p>
        </main>
    </body>
</html>