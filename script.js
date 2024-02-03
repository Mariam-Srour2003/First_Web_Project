const textArray = ['مرحبًا بكم في موقع أحداث الكلية لدينا! ستجد هنا أحدث المعلومات حول الأحداث المثيرة التي تحدث في الحرم الجامعي. هدفنا هو خلق بيئة ممتعة وجذابة حيث يمكن للطلاب وأعضاء هيئة التدريس وأعضاء المجتمع الاجتماع معًا للتعلم والنمو والاستمتاع. نحن نؤمن بأن الأحداث جزء مهم من الحياة الجامعية ، ونحن ملتزمون بتوفير مجموعة متنوعة وشاملة من الأنشطة التي تعكس اهتمامات وشغف مجتمعنا. لذلك سواء كنت جديدًا طالبًا يتطلع إلى المشاركة ، أو عضوًا في المجتمع منذ فترة طويلة يبحث عن شيء جديد ومثير للقيام به ، ندعوك لاستكشاف موقعنا والانضمام إلينا في حدثنا القادم', 'Welcome to our college events website! Here, you will find all the latest information on the exciting events happening on our campus. Our goal is to create a fun and engaging environment where students, faculty, and community members can come together to learn, grow, and have fun. We believe that events are an important part of college life, and we are committed to providing a diverse and inclusive range of activities that reflect the interests and passions of our community. So whether you are a new student looking to get involved, or a longtime community member looking for something new and exciting to do, we invite you to explore our website and join us at our next event!'];
        let index = 0;
        function changeText() {
            const textElement = document.getElementById('textabout');
            textElement.innerHTML = textArray[index];
            index++;
            if (index >= textArray.length) {
                index = 0;
            }
            const newText = textArray[index];
            textElement.innerHTML = newText;
            textElement.classList.remove('fade-in');
            void textElement.offsetWidth;
            textElement.classList.add('fade-in');
            setTimeout(() => {
                textElement.classList.remove('fade-in');
                textElement.innerHTML = oldText;
            }, 4000);
        }

        setInterval(changeText, 5000);


        $(document).ready(function () {
            $("#hyperdeventtxt").mouseenter(function () {
                $("#abouteventtypes").html("Hybrid events combine elements of both online and on-campus events, offering attendees the flexibility to participate in person or virtually. They can include features such as live streaming, virtual breakout rooms, and online chat, making them accessible to a wider audience.");
            }).mouseleave(function () {
                $("#abouteventtypes").html("");
            });
        });

        $(document).ready(function () {
            $("#onlineeventtxt").mouseenter(function () {
                $("#abouteventtypes").html("Online events are completely digital, accessible from anywhere with an internet connection. They are popular for their convenience and can range from webinars and virtual conferences to livestreams of performances or presentations.");
            }).mouseleave(function () {
                $("#abouteventtypes").html("");
            });
        });

        $(document).ready(function () {
            $("#oncampuseventtxt").mouseenter(function () {
                $("#abouteventtypes").html("These events occur at a physical location and can range from workshops and lectures to sports andcultural events. They offer an opportunity for attendees to interact with others in-person and experience a different atmosphere than what is available online");
            }).mouseleave(function () {
                $("#abouteventtypes").html("");
            });
        });

        function loadImage(event) {
            var image = document.querySelector('.eventimage');
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
        var eventName = '';

        function updateEventName(value) {
            var eventNameElement = document.querySelector('.eventname');
            eventName = value;
            if (value.length > 15) {
                eventNameElement.textContent = value.substring(0, 15) + '...';
                eventNameElement.title = value;
            } else {
                eventNameElement.textContent = value;
                eventNameElement.title = '';
            }
        }
        
        var eventInfo = '';

        function updateInfoAboutEvent(value) {
            var eventInfoElement = document.querySelector('.eventinfo');
            eventInfo = value;
            if (value.length > 29) {
                eventInfoElement.textContent = value.substring(0, 29) + '...';
                eventInfoElement.title = value;
            } else {
                eventInfoElement.textContent = value;
                eventInfoElement.title = '';
            }
        }
        function updateEventType() {
            var eventType = document.querySelector('select').value;
            var eventTypeElement = document.querySelector('.eventtype');
            eventTypeElement.innerHTML = eventType;
        }
        function updateEventDate() {
            var eventDate = document.getElementById('event-date').value;
            var eventDateElement = document.querySelector('.eventDate');
            eventDateElement.innerHTML = eventDate;
        }
        function updateEventTime() {
            var eventTime = document.getElementById('event-time').value;
            var eventTimeElement = document.querySelector('.eventTime');
            eventTimeElement.innerHTML = eventTime;
        }

        const sidebarToggle = document.getElementById("sidebar-toggle");
            const sidebarNav = document.querySelector(".sidebar-nav");

            sidebarToggle.addEventListener("click", function () {
                sidebarNav.classList.toggle("active");
            });
            const hideSidebarButton = document.getElementById("hide-sidebar");
            const sidebar = document.getElementById("sidebar-nav");

            hideSidebarButton.addEventListener("click", function () {
                sidebarNav.classList.remove("active");
            });
            const clearChoicesButton = document.getElementById("clear-choices");
            const choices = document.querySelectorAll(".choice");

            clearChoicesButton.addEventListener("click", function () {
                choices.forEach(function (choice) {
                    choice.checked = false;
                });
                document.querySelector('#filter_choosen').textContent = "All Events";
            });
            function updateFilterText() {
                var typeChoices = document.querySelectorAll('input[name="type"]:checked');
                var timeChoice = document.querySelector('input[name="time"]:checked');
                var seatsChoice = document.querySelector('input[name="seats"]:checked');
                var filterText = "All Events";

                if (typeChoices.length > 0) {
                    filterText = '';
                    for (var i = 0; i < typeChoices.length; i++) {
                        filterText += typeChoices[i].value + ', ';
                    }
                    filterText = filterText.slice(0, -2);
                }

                if (timeChoice) {
                    filterText += ' - ' + timeChoice.value;
                }

                if (seatsChoice) {
                    filterText += ' - ' + seatsChoice.value;
                }

                document.querySelector('#filter_choosen').textContent = filterText;
            }
            window.onload = function() {
                var homeButton = document.getElementById("Home");
                homeButton.addEventListener("click", function () {
                    window.close();
                    window.open("MARIAMSROURPROJECT.html");
                });
    
                var eventsButton = document.getElementById("events");
                eventsButton.addEventListener("click", function () {
                    window.close();
                    window.open("eventspage.html");
                });
            };