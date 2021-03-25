@extends('layouts.app')

@section("content")
    <div class="container">
        <nav class="header-single-rest">
            <div class="single-restaurant-logo">
                <a href="{{ route('uiHome') }}">
                    <img src="../img/logo.png" alt="">
                </a>
            </div>
            <div class="header-bar-menu">
                <ul>
                    <li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-house-user"></i> {{ __('Login') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    Dashboard
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <li>
                        <a class="nav-link" onclick="show('faq-drop-menu')" href="#">
                            <i class="fas fa-bars"></i> Menu
                        </a>
                    </li>
                </ul>
            </div>
            <div id="faq-drop-menu" style="display:none">
                <div class="faq-drop-top">
                    <div class="faq-drop-close">
                        <img src="../img/logo.png" alt="">
                        <i onclick="show('faq-drop-menu')" class="fas fa-times"></i>
                    </div>
                    <div class="btn-login">
                        <button class="btn btn-deliveroo"type="button" name="button">Log in</button>
                    </div>

                    <div class="faq-info">
                        <a id="faq" href="{{ route('faq') }}">
                            <i class="far fa-question-circle"></i> faq
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="info-faq">
        <div class="container">
            <h1>faq</h1>
            <div class="info-faq-content">
                <div class="info-faq-content-left">
                    <ul>
                        <li>
                            <a href="#coronavirus">Coronavirus</a>
                        </li>
                        <li>
                            <a href="#su-deliveroo">Su Deliveroo</a>
                        </li>
                        <li>
                            <a href="#utilizzare-deliveroo">Utilizzare Deliveroo</a>
                        </li>
                        <li>
                            <a href="#domande">Domande Sul Mio Ordine</a>
                        </li>
                        <li>
                            <a href="#spese">Spese e tariffe</a>
                        </li>
                        <li>
                            <a href="#amici">Invita Gli Amici</a>
                        </li>
                        <li>
                            <a href="#altro">Altro?</a>
                        </li>
                        <li>
                            <a href="#deliveroo-plus">Deliveroo Plus</a>
                        </li>
                    </ul>
                </div>
                <div class="info-faq-content-right">
                    <h2 id="coronavirus">Coronavirus</h2>
                    <h3>Ordinare tramite Deliveroo è sicuro?</h3>
                    <p>La nostra priorità assoluta è far sì che il nostro servizio sia quanto più sicuro possibile per tutti e per questo abbiamo introdotto una serie di importanti norme di sicurezza per i nostri clienti, i nostri ristoranti partner e i rider che collaborano con noi. Abbiamo introdotto, ad esempio, la modalità di consegna “senza contatto”, delle linee guida su come gestire il ristorante per la consegna degli ordini e delle rigorose norme igieniche sia per i ristoranti che per i rider. Inoltre, siamo a stretto contatto con le autorità sanitarie per assicurarci di fornire sempre linee guida aggiornate e di garantire un servizio che sia il più sicuro possibile. Sappiamo che si tratta di un periodo molto particolare per tutti e per questo vogliamo garantire a clienti, ristoranti e rider tutto il supporto necessario in questa situazione di emergenza.</p>
                    <h3>Come funziona la consegna “senza contatto”?</h3>
                    <p>La funzione “consegna senza contatto” è attiva per tutte le consegne di Deliveroo. Il rider visualizzerà nelle note di consegna dell’ordine le indicazioni del cliente e seguirà una semplice procedura per garantire che non vi sia alcun tipo di contatto quando viene consegnato l’ordine.
                    Il rider dovrà informare il cliente di essere arrivato all’indirizzo indicato, lascerà l’ordine fuori dalla porta, si posizionerà a una distanza di sicurezza e attenderà che il cliente ritiri l’ordine. Anche i rider possono comunicare con il cliente per effettuare consegne senza contatto; in tal caso informeranno il cliente tramite l’app prima di arrivare all’indirizzo di consegna.</p>
                    <h3>Su Deliveroo sono disponibili tutti i ristoranti come al solito?</h3>
                    <p>Il governo italiano ha ordinato la chiusura al pubblico di tutti i ristoranti, i bar e le caffetterie, i quali possono proseguire la propria attività offrendo esclusivamente un servizio di consegna. Se un ristorante desidera tenere aperta la propria cucina e preparare piatti da consegnare ai clienti può sempre farlo tramite Deliveroo, ma è una scelta che deve prendere il ristorante stesso. </p>
                    <h3>In che modo Deliveroo sta aiutando i rider?</h3>
                    <p>
                        Da quanto è iniziata l’emergenza COVID-19, stiamo facendo il possibile per aiutare costantemente i rider che collaborano con noi:
                        <ul>
                            <li>Linee guida aggiornate: dettagliate norme igieniche e gli ultimi aggiornamenti sono disponibili sul nostro sito dedicato ai rider.</li>
                            <li>Assicurazione e Fondo di sostegno per i rider Deliveroo: i rider che collaborano abitualmente con Deliveroo e che mostrano i sintomi del COVID-19 o che sono stati sottoposti ad autoisolamento dalle autorità sanitarie, possono richiedere un supporto finanziario tramite la nostra assicurazione e il nostro fondo di sostegno.</li>
                            <li>Modalità “senza contatto” per il ritiro e la consegna degli ordini: abbiamo introdotto il ritiro e la consegna degli ordini in modalità “senza contatto” in tutta Italia. Ciò permette ai rider di evitare contatti sia con i clienti che con il personale dei ristoranti. </li>
                            <li>Prodotti gratuiti: i rider possono richiedere un rimborso (fino a un massimo di 25€) sull’acquisto di prodotti sanitari come disinfettanti per le mani e mascherine protettive. </li>
                        </ul>
                    </p>
                    <h3>In che modo Deliveroo sta aiutando i ristoranti?</h3>
                    <p>
                        Stiamo garantendo tutta la nostra assistenza ai ristoranti che vogliono continuare a offrire ottimi piatti a chi è costretto a rimanere a casa durante questa emergenza. Stiamo aiutando i ristoranti a ottimizzare la propria attività per offrire un servizio di sola consegna e stiamo facendo il possibile per far sì che chiunque possa ordinare i piatti che desidera in questo periodo difficile. Abbiamo:
                        <ul>
                            <li>Condiviso linee guida dettagliate su come offrire un servizio di sola consegna sicuro, dando consigli su come diminuire i contatti, su come impacchettare gli ordini e su come garantire il massimo livello di igiene.</li>
                            <li>Sviluppato delle azioni di marketing online mirate per comunicare ai clienti che i ristoranti stanno proseguendo la propria attività offrendo un servizio di sola consegna.</li>
                            <li>Creato dei team che si occupano di acquisire e supportare i ristoranti che desiderano offrire il servizio di consegna.</li>
                            <li>Sviluppato un’app per far conoscere la nuova modalità di “consegna senza contatto”, in modo che i ristoranti possano rassicurare i clienti che le consegne saranno portate a termine seguendo tutte le misure di sicurezza necessarie.</li>
                            <li>Condiviso consigli pratici e linee guida su come gestire la propria attività durante l’emergenza COVID-19.</li>
                            <li>Portato avanti una campagna per garantire ai ristoranti maggiore sostegno da parte del governo.</li>
                        </ul>
                    </p>
                    <h3>Che succede se ho una richiesta o un reclamo in sospeso?</h3>
                    <p>Il nostro team del servizio clienti si occuperà di offrire assistenza a tutti quei clienti che abbiano una richiesta o un reclamo in sospeso. Nonostante la richiesta sia particolarmente alta negli ultimi tempi, ci occuperemo tempestivamente di ciascun caso.</p>
                    <h3>Come posso contattarvi?</h3>
                    <p>Abbiamo dei team dedicati per offrire assistenza ai nostri clienti, ai nostri ristoranti partner e ai rider che collaborano con noi in questo periodo molto difficile. Scrivi un’email a support@deliveroo.it oppure inviaci un messaggio tramite Facebook o Twitter.</p>
                    <h2 id="su-deliveroo">Su Deliveroo</h2>
                    <h3>Cos'è Deliveroo?</h3>
                    <p>La missione di Deliveroo è quella di trasformare il mondo del cibo a domicilio. Collaboriamo con i migliori ristoranti della città - dalle gemme locali alle grandi catene nazionali - per portarti dove vuoi i tuoi piatti preferiti.
                    Con centinaia di ristoranti e rider esperti, ti consegniamo il tuo ordine il più velocemente possibile.</p>
                    <h3>Qual È La Storia Della Fondazione Di Deliveroo?</h3>
                    <p>Deliveroo è un'azienda inglese digitale con una storia di successo. Dopo essersi trasferito da New York a Londra, il nostro fondatore rimase stupito dal non trovare servizi di food delivery di qualità. Quindi decise che la sua missione sarebbe stata quella di portare i piatti dei migliori ristoranti direttamente casa dei loro clienti.
                    Il nostro servizio oggi è attivo in più di 100 città in tutto il mondo, offrendo lavoro a più di 600 ingegneri e impiegati nel quartier generale di Londra, collaborando con più di 8000 ristoranti e 15000 riders.</p>
                    <h2 id="utilizzare-deliveroo">Utilizzare Deliveroo</h2>
                    <h3>Come Funziona?</h3>
                    <p>Puoi ordinare sia dal sito sia dalla nostra app, disponibile per iOS e Android. Aggiungi il tuo indirizzo di consegna per vedere quali ristoranti consegnano da te, scegli i tuoi piatti preferiti ed effettua l'ordine.
                    Quando il tuo ordine viene accettato, il ristorante inizia a prepararlo e a confezionarlo. Una volta pronto, un nostro rider lo ritira e lo porta da te.
                    Se vuoi essere super organizzato, puoi ordinare fino a 24 ore in anticipo con un ordine programmato.</p>
                    <h3>Che Tipo Di Ristoranti Trovo Su Deliveroo?</h3>
                    <p>Ci prendiamo cura personalmente di proporti un'ampia selezione di ristoranti di alta qualità nella tua area. Questo significa che puoi trovare dal miglior ristorante giapponese, all'hamburgheria più gustosa, alla pizzeria italiana tradizionale con forno a legna. L'unica cosa che non troverai su Deliveroo sono ristoranti di scarsa qualità.</p>
                    <h3>Per Che Ora Posso Ordinare?</h3>
                    <p>Consegniamo tutti i giorni dal mattino (in alcune città) alla sera tardi e i ristoranti hanno orari differenti. Visita la nostra homepage o l'app per vedere quali ristoranti consegnano nella tua zona.</p>
                    <h3>Come Viene Consegnato Il Cibo?</h3>
                    <p>Una volta che hai effettuato l'ordine, il ristorante lo riceve, lo prepara e lo impacchetta. Quando è pronto, un rider lo ritira e si reca all'indirizzo di consegna.</p>
                    <h3>Perchè Deliveroo Non Accetta Contanti?</h3>
                    <p>Accettiamo solo pagamenti con carta perchè ci permette di offrirti la migliore esperienza possibile. Crea un ambiente di lavoro più lavoro per i nostri riders. Puoi comunque dare la mancia in contati al tuo rider.</p>
                    <h3>Devo Lasciare La Mancia?</h3>
                    <p>Lasciare la mancia è completamente a tua discrezione. Puoi lasciarla mentre effettui l'ordine via app oppure darla in contanti al nostro rider quando ti consegna l'ordine. I nostri rider ricevono il 100% di tutte le mance.</p>
                    <h3>C'è Un Ordine Minimo?</h3>
                    <p>L'ordine minimo potrebbe variare a seconda del ristorante da cui ordini. Ti verrà mostrato al momento del checkout prima di pagare.</p>
                    <h3>Come Faccio Ad Usare Un Codice Sconto?</h3>
                    <p>Se hai un codice promozionale, puoi inserirlo nell'app o sul sito.
                    Se stai usando l'app iOS, entra nel tuo account e inserisci il codice nel campo "Inserisci un codice". Sul sito o nell'app Android, clicca su "Aggiungi un promocode" al momento del checkout.</p>
                    <h3>I Piatti Hanno Gli Stessi Prezzi Di Quelli Ordinati In Sala?</h3>
                    <p>Consigliamo sempre ai nostri ristoranti di mantenere su Deliveroo gli stessi prezzi che hanno in sala, ma ci potrebbero essere delle eccezioni.
                    Il prezzo di ogni piatto viene mostrato nell'app. Se hai qualsiasi domanda sul prezzo dei menù, per favore contatta direttamente il ristorante.</p>
                    <h3>Posso Fare Un Ordine In Anticipo?</h3>
                    <p>Sì! Puoi programmare gli ordini fino ad un giorno in anticipo e scegliere qualsiasi orario di consegna da mezzogiorno in poi.</p>
                    <h3>Posso Ritirare Il Mio Ordine?</h3>
                    <p>Sì, puoi usare l'opzione Ritiro di Deliveroo per ritirare gli ordini dai ristoranti che offrono questo servizio. Vai sull'app per scoprire se il servizio è disponibile anche nei ristoranti della tua zona.</p>
                    <h3>Come Viene Confezionato Il Cibo?</h3>
                    <p>Il packaging dipende sempre dalla tipologia di cibo e dal ristorante da cui hai ordinato. I nostri ristoranti hanno molta cura nell'utilizzare packaging che mantenga la giusta temperatura il più a lungo possibile.Se hai suggerimenti riguardo al packaging o sull'aspetto del cibo che ti è stato consegnato, per favore contattaci via mail all'indirizzo support@deliveroo.it e comunicheremo i tuoi feedback al ristorante.</p>
                    <h2 id="domande">Domande Sul Mio Ordine</h2>
                    <h3>E Se Succede Qualcosa Al Mio Ordine?</h3>
                    <p>Abbiamo un team dedicato a seguire tutta la tua esperienza con Deliveroo, dal momento in cui effettui l'ordine a quando ti viene consegnato.
                    Purtroppo gli imprevisti possono capitare a tutti. In questo caso, puoi utilizzare la funzione di Aiuto nell'app per parlare con il nostro customer service per ogni problema.
                    Puoi anche contattarci scrivendo una mail a support@deliveroo.it.</p>
                    <h3>Cosa Faccio Se Ho Dimenticato Di Aggiungere Qualcosa Al Mio Ordine?</h3>
                    <p>Puoi contattare il nostro customer service tramite la funzione Aiuto nell'app e faremo del nostro meglio per essere certi che i piatti mancanti vengano aggiunti al tuo ordine.</p>
                    <h3>Cosa Succede Se Il Mio Ordine È In Ritardo?</h3>
                    <p>A volte può succedere che accadano imprevisti che no possiamo controllare. Proviamo sempre a metterci in contatto con te quando capiamo che potrebbe esserci un ritardo e il nostro team fa sempre in modo di consegnarti l'ordine il prima possibile.</p>
                    <h3>Cosa Succede Se Non Ci Sono Quando Arriva Il Mio Rider?</h3>
                    <p>Se pensi di non riuscire a trovarti all'indirizzo indicato in tempo per ricevere il tuo ordine, contattataci attraverso la funzione di Aiuto all'interno dell'app.
                    Il nostro rider proverà a chiamarti nel caso in cui ci siano problemi una volta raggiunto il tuo indirizzo. Se non riuscisse a contattarti, il nostro Customer Service proverà a mettersi in contatto con te via telefono e email. Per favore controlla le tue email mentre attendi l'ordine per ogni aggiornamento.
                    Se non riuscissimo a contattarti e non riuscissimo a consegnare l'ordine, il tuo rider attenderà fino a 10 minuti all'indirizzo indicato. Trascorso questo tempo, andrà via e l'importo ti verrà comunque addebitato. Per evitare che succeda, ti consigliamo di controllare sempre i dettagli di indirizzo e numero di telefono all'interno dell'ordine.</p>
                    <h3>Ho ricevuto una chiamata dal numero +39 095 8100410, a chi appartiene?</h3>
                    <p>Il numero 0958100410 è utilizzato dal rider quando ha bisogno di contattarti per farti sapere che è arrivato. Tieni il telefono a portata di mano e rispondi all’eventuale chiamata, così il rider potrà consegnarti l’ordine.</p>
                    <h2 id="spese">Spese e tariffe</h2>
                    <h3>Come funzionano?</h3>
                    <span>Spese di consegna</span>
                    <p>Più sei vicino al ristorante, minori saranno le spese di consegna. Alcuni ristoranti gestiscono in autonomia le consegne e le spese di consegna.</p>
                    <span>Spese di servizio</span>
                    <p>Ci aiutano a migliorare l'app e a tenere aperto il servizio clienti 7 giorni su 7.</p>
                    <span>Supplemento</span>
                    <p>Tariffa per ordini che non raggiungono la spesa minima fissata per il ristorante; è possibile effettuare l'ordine, ma verrà applicata questa tariffa sul totale. Aggiungi altro al carrello per rimuoverla.</p>
                    <h2 id="amici">Invita Gli Amici</h2>
                    <h3>Sono Già Cliente. Posso Ottenere Del Credito Se Mi Iscrivo?</h3>
                    <p>Ci dispiace, ma questa offerta è valida solo per i nuovi clienti di Deliveroo. Non creare nuovi account perché ce ne accorgiamo! Per saperne di più, per favore clicca qui T&C</p>
                    <h3>Non Riesco A Vedere Il Link Di Invito - Dove Si Trova?</h3>
                    <p>Devi aver effettuato un certo numero di ordini per poter avere il tuo link personale per invitare i tuoi amici. Una volta effettuati gli ordini, il link ti verrà inviato via email, così potrai condividerlo con i tuoi amici, parenti, colleghi, tutti!</p>
                    <h2 id="altro">Altro?</h2>
                    <h3>Cosa Succede Se Ho Delle Allergie?</h3>
                    <p>Se hai qualche allergia specifica e vuoi maggiori informazioni a proposito di qualche piatto indicato nel menu, per favore controlla la sezione note del ristorante nel menu. Per maggiori informazioni ti preghiamo di contattare il ristorante direttamente.</p>
                    <h3>Quando Arriverete A Consegnare Nella Mia Zona?</h3>
                    <p>CI espandiamo in fretta e speriamo di collaborare presto con i ristoranti vicini a te!</p>
                    <h3>C'è La Possibilità Di Avere Un Profilo Aziendale Su Deliveroo?</h3>
                    <p>Abbiamo un team dedicato che sarà felice di assisterti nella creazione del tuo account, in modo che tu possa ordinare colazioni per alzare il morale del tuo team, pranzi di lavoro e anche catering. Contattaci al aziende@deliveroo.it</p>
                    <h3>Esiste L'app Di Deliveroo?</h3>
                    <p>Eccola! È disponibile gratuitamente nell'App Store e su Google Play.</p>
                    <h3>Ordinanza Tribunale di Bologna, 31/12/2020, rgn 2949/2019</h3>
                    <p>Scarica il PDF</p>
                    <h2 id="deliveroo-plus">Deliveroo Plus</h2>
                    <h3>Cos'è Deliveroo Plus?</h3>
                    <p>Deliveroo Plus è il nostro servizio in abbonamento che ti permette di ordinare senza spese di consegna su ogni ordine da te effettuato presso i ristoranti aderenti e che soddisfi il requisito del minimo d’ordine richiesto, nonché l'accesso a offerte esclusive solo per membri.</p>
                    <h3>Come posso iscrivermi a Deliveroo Plus?</h3>
                    <p>Alcuni clienti visualizzeranno l’opzione sul sito oppure sull'app.</p>
                    <h3>C'è un limite di ordini che posso effettuare?</h3>
                    <p>No, puoi effettuare quanti ordini vuoi con Deliveroo Plus. Ricorda però che il servizio deve essere utilizzato da una sola persona. Gli ordini effettuati devono essere conformi ai nostri termini e condizioni.</p>
                    <h3>Come posso gestire la mia iscrizione?</h3>
                    <p>Per gestire la tua iscrizione devi accedere alla sezione “Account”. Qui potrai modificare il metodo di pagamento utilizzato per l’abbonamento, visualizzare la data del prossimo pagamento e tanto altro.</p>
                    <h3>Quando mi sarà addebitato il costo?</h3>
                    <p>Per verificare la tua prossima data di pagamento, vai alla sezione “Account”.</p>
                    <h3>Posso condividere il mio account Deliveroo Plus?</h3>
                    <p>No. Condividere l'iscrizione al programma con altri utenti costituisce una violazione dei termini di utilizzo di Deliveroo Plus e potrebbe indurci a prendere provvedimenti sul tuo account in conformità ai termini e condizioni del servizio Deliveroo Plus.</p>
                    <h3>Come posso cancellare l'iscrizione?</h3>
                    <p>Puoi cancellare la tua iscrizione dalla sezione Account, oppure contattando il Servizio Clienti via email a support@deliveroo.it.</p>
                    <h3>Posso modificare la data del pagamento?</h3>
                    <p>No. Puoi visualizzare la data del tuo prossimo pagamento nella sezione “Account”.</p>
                    <h3>Se cancello l'iscrizione, mi sarà rimborsato l'importo?</h3>
                    <p>Se cancelli la tua iscrizione a Deliveroo Plus entro 14 giorni dalla data del primo pagamento, hai diritto al rimborso totale. Se cancelli dopo 14 giorni, non hai diritto ad alcun rimborso.
                    Contatta il Servizio Clienti via email a support@deliveroo.it.</p>
                    <h3>Sono un cliente Deliveroo for Business. Posso usufruire di non pagare le spese di  consegna su ordini effettuati con credito aziendale?</h3>
                    <p>No, questo vantaggio non viene applicato agli ordini effettuati utilizzando il credito aziendale. Puoi sempre usufruire di non pagare le spese di consegna sui tuoi ordini personali non effettuati con credito aziendale.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
