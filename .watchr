require "open3"

watch("application/(models|controllers)/(.*).php") do |match|
  test_changed_application(match[0])
end

watch("tests/(.*/.*)\.php") do |match|
  phpunit match[0]
end

def test_changed_application(file)
  type = file.split('/')[1]
  name = file.split('/')[2].split('.')[0]
  #system "phpunit --verbose  --colors application/tests/#{type}/test#{name.capitalize}"
  phpunit "tests/#{type}/#{name.capitalize}Test.php"
  #phpunit "tests/#{type}/test#{name.capitalize}.php"
end

def say what
  puts "\n[#{Time.now.strftime('%H:%M:%S')}] #{what}\n"
end

def phpunit file


  if File.exists? file
    
    cmd = "phpunit #{file}" # redirect stderr to stdout
    say "About to run '#{cmd}'"
    
    
    previous = last = nil
    status = Open3::popen3(cmd) do |stdin,stdout,stderr|
        stdout.each do |line| 
               previous = last
               puts last = line              
        end
        say stdout.gets
    end
  
    
  # status = Open3::popen3('phpunit application/tests/controllers/testWelcome.php 2>&1') do |stdin,stdout,stderr|
  #      stdout.each { |line| puts "stdout:"+line }
  #      say stdout.gets
  #  end

    file_name = File.basename(file)
    image, summary, message = case
    when last =~ /\AOK/ # PHPUnit is green
      ['dialog-ok', file_name, last.gsub('OK (', '').gsub(')', '')]
    when previous =~ /\AOK, but incomplete or skipped tests/ # PHPUnit is yellow
      ['dialog-question', file_name, last]
    when last =~ /\APHP/ # PHP Fatal error, PHPUnit process crashed
      ['dialog-error', 'Fatal error!', last]
    else # PHPUnit is red
      ['dialog-warning', previous, last]
    end


      say message
    # `--hint=string:x-canonical-private-synchronous:` is a workaround for `-t`
    system "notify-send  --hint=string:x-canonical-private-synchronous: -i '#{image}' '#{summary}' '#{message}'"
    say "waiting..."
  end
end
