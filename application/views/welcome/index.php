<h1>application::views::welcome::show</h1>

<h2>Rendering a partials with locals</h2>        
<?= render_partial('welcome/_list_peoples.php', $locals_vars ); ?>

<h2>Rendering a collection of partials</h2>        
<?= render_partial('welcome/_peoples.php', 
                    $locals_vars,
                    $peoples ); ?>
                    
<p>Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolem Lorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem
Lorem ipsum dolem lorem ipsum dolemLorem ipsum dolem lorem ipsum dolem</p>

