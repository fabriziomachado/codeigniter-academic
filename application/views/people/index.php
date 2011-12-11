<h1>application::views::welcome::show</h1>

<h2>Rendering a partials with locals</h2>        
<?= render_partial('people/_list_people.php', $locals_vars ); ?>

<h2>Rendering a collection of partials</h2>        
<?= render_partial('people/_people.php', 
                    $locals_vars,
                    $people ); ?>
                    
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

