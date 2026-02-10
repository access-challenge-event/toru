<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Heritage Open Day: Explore the Abbey',
                'slug' => 'heritage-open-day-explore-the-abbey',
                'description' => "Join us for a special Heritage Open Day at Delapre Abbey! This free event offers a rare opportunity to explore areas of the Abbey not usually open to the public.\n\nDiscover the fascinating history of this medieval abbey, from its founding by the Cluniac order in 1145 through to its role in the Battle of Northampton and its transformation into a grand country house.\n\nExpert guides will be on hand throughout the day to share stories and answer your questions. Refreshments will be available in the café.\n\nThis is a family-friendly event suitable for all ages. Children must be accompanied by an adult.",
                'short_description' => 'Explore hidden areas of the 900-year-old abbey with expert guides. A rare opportunity to see behind closed doors.',
                'category' => 'heritage',
                'location' => 'Delapre Abbey — Main Hall',
                'start_date' => now()->addDays(14)->setTime(10, 0),
                'end_date' => now()->addDays(14)->setTime(16, 0),
                'capacity' => 120,
                'spots_remaining' => 87,
                'status' => 'published',
                'featured' => true,
            ],
            [
                'title' => 'Family Craft Workshop: Medieval Shields',
                'slug' => 'family-craft-workshop-medieval-shields',
                'description' => "Get creative with the whole family at our Medieval Shield workshop! Children (and adults!) will learn about heraldry and design their own medieval shield using traditional techniques.\n\nAll materials are provided. The workshop is suitable for children aged 5 and over. Children must be accompanied by a participating adult.\n\nThe workshop takes place in our dedicated learning space on the ground floor, which is fully accessible.\n\nPlease wear clothes that you don't mind getting a little messy!",
                'short_description' => 'Create your own medieval shield in this hands-on family workshop. All materials provided.',
                'category' => 'family',
                'location' => 'Delapre Abbey — Learning Suite',
                'start_date' => now()->addDays(7)->setTime(11, 0),
                'end_date' => now()->addDays(7)->setTime(13, 0),
                'capacity' => 30,
                'spots_remaining' => 12,
                'status' => 'published',
                'featured' => true,
            ],
            [
                'title' => 'Spring Exhibition: Flowers of the Walled Garden',
                'slug' => 'spring-exhibition-flowers-walled-garden',
                'description' => "Celebrate the arrival of spring with our stunning floral exhibition in the historic Walled Garden.\n\nLocal artists and photographers have captured the beauty of Delapre Abbey's gardens through paintings, prints, and photographs. This exhibition showcases the changing seasons in our Walled Garden, from the first snowdrops to the vibrant summer borders.\n\nFree entry. The exhibition runs daily from 10am to 4pm. No booking required for general admission, but guided tours of the exhibition must be booked in advance.\n\nThe Walled Garden is accessible via gravel paths. Please contact us if you have specific accessibility requirements.",
                'short_description' => 'A beautiful exhibition celebrating the Abbey\'s historic Walled Garden through art and photography.',
                'category' => 'exhibition',
                'location' => 'Delapre Abbey — Walled Garden',
                'start_date' => now()->addDays(21)->setTime(10, 0),
                'end_date' => now()->addDays(21)->setTime(16, 0),
                'capacity' => 80,
                'spots_remaining' => 80,
                'status' => 'published',
                'featured' => true,
            ],
            [
                'title' => 'Guided Tour: The Battle of Northampton',
                'slug' => 'guided-tour-battle-of-northampton',
                'description' => "Step back in time to 1460 and learn about the pivotal Battle of Northampton, which took place on the grounds of Delapre Abbey during the Wars of the Roses.\n\nOur expert historian will guide you around the battlefield site, bringing the events of July 10th 1460 to life through vivid storytelling and historical evidence.\n\nThe tour covers approximately 1.5 miles of mostly flat terrain. Please wear sturdy footwear and dress for the weather.\n\nDuration: approximately 90 minutes.",
                'short_description' => 'Walk the 1460 battlefield site with an expert historian. Discover the Abbey\'s role in the Wars of the Roses.',
                'category' => 'heritage',
                'location' => 'Delapre Abbey — Meeting Point: Main Entrance',
                'start_date' => now()->addDays(10)->setTime(14, 0),
                'end_date' => now()->addDays(10)->setTime(15, 30),
                'capacity' => 25,
                'spots_remaining' => 18,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'title' => 'Children\'s Storytime: Tales of the Abbey',
                'slug' => 'childrens-storytime-tales-of-the-abbey',
                'description' => "Join our storyteller for a magical session of stories inspired by the history of Delapre Abbey.\n\nDesigned for children aged 3-7, this interactive session includes songs, puppets, and plenty of audience participation.\n\nSessions last approximately 45 minutes. Children must be accompanied by an adult at all times.\n\nThe session takes place in our cosy Reading Room on the first floor. A lift is available.",
                'short_description' => 'Magical storytelling for young children with songs, puppets, and tales inspired by the Abbey.',
                'category' => 'family',
                'location' => 'Delapre Abbey — Reading Room',
                'start_date' => now()->addDays(5)->setTime(10, 30),
                'end_date' => now()->addDays(5)->setTime(11, 15),
                'capacity' => 20,
                'spots_remaining' => 6,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'title' => 'Watercolour Workshop: Paint the Abbey',
                'slug' => 'watercolour-workshop-paint-the-abbey',
                'description' => "Spend a relaxing afternoon painting Delapre Abbey in watercolours.\n\nLed by local artist Sarah Mitchell, this gentle introduction to watercolour painting is suitable for complete beginners and more experienced painters alike. All materials are provided.\n\nWe'll set up easels in the grounds with views of the Abbey's stunning south facade. In case of rain, we'll paint from reference photographs in the workshop space.\n\nLight refreshments included. Duration: 3 hours.",
                'short_description' => 'A relaxing watercolour painting session in the Abbey grounds. Suitable for all abilities.',
                'category' => 'workshop',
                'location' => 'Delapre Abbey — South Lawn',
                'start_date' => now()->addDays(18)->setTime(13, 0),
                'end_date' => now()->addDays(18)->setTime(16, 0),
                'capacity' => 15,
                'spots_remaining' => 15,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'title' => 'Summer Solstice Celebration',
                'slug' => 'summer-solstice-celebration',
                'description' => "Mark the longest day of the year with a special celebration at Delapre Abbey.\n\nEnjoy live music, Morris dancing, children's activities, and food stalls in the beautiful Abbey grounds. The evening concludes with a guided sunset walk through the Walled Garden.\n\nThis is an outdoor event. Please bring blankets or folding chairs. A limited number of indoor spaces are available for those who need them.\n\nProgramme:\n- 5:00pm — Gates open, food stalls\n- 5:30pm — Morris dancing display\n- 6:00pm — Live folk music\n- 7:30pm — Children's activities\n- 8:30pm — Sunset garden walk",
                'short_description' => 'Celebrate the longest day with live music, Morris dancing, food stalls, and a sunset garden walk.',
                'category' => 'seasonal',
                'location' => 'Delapre Abbey — Main Grounds',
                'start_date' => now()->addDays(30)->setTime(17, 0),
                'end_date' => now()->addDays(30)->setTime(21, 0),
                'capacity' => 200,
                'spots_remaining' => 143,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'title' => 'Photography Walk: Architecture & Nature',
                'slug' => 'photography-walk-architecture-nature',
                'description' => "Capture the beauty of Delapre Abbey through your lens in this guided photography walk.\n\nProfessional photographer James Webb will share tips and techniques for photographing architecture and nature, using the Abbey and its grounds as our stunning backdrop.\n\nSuitable for all camera types, including smartphones. Some walking is involved — please wear comfortable shoes.\n\nDuration: 2 hours. Meet at the main entrance.",
                'short_description' => 'A guided photography walk exploring the Abbey\'s architecture and natural beauty. All cameras welcome.',
                'category' => 'workshop',
                'location' => 'Delapre Abbey — Main Entrance',
                'start_date' => now()->addDays(25)->setTime(9, 30),
                'end_date' => now()->addDays(25)->setTime(11, 30),
                'capacity' => 20,
                'spots_remaining' => 20,
                'status' => 'published',
                'featured' => false,
            ],
            [
                'title' => 'Local History Talk: Northampton Through the Ages',
                'slug' => 'local-history-talk-northampton-ages',
                'description' => "Join historian Dr. Eleanor Marsh for a fascinating illustrated talk about the history of Northampton and the role Delapre Abbey has played over nine centuries.\n\nFrom its founding as a Cluniac nunnery, through the English Civil War, to its 21st-century restoration, discover the remarkable stories hidden within these walls.\n\nThe talk takes place in the Great Hall and lasts approximately 1 hour, followed by a Q&A session.\n\nRefreshments served afterwards.",
                'short_description' => 'An illustrated talk tracing 900 years of Northampton history through the lens of Delapre Abbey.',
                'category' => 'heritage',
                'location' => 'Delapre Abbey — Great Hall',
                'start_date' => now()->addDays(12)->setTime(19, 0),
                'end_date' => now()->addDays(12)->setTime(20, 30),
                'capacity' => 60,
                'spots_remaining' => 42,
                'status' => 'published',
                'featured' => false,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }

        // Add some sample bookings
        $sampleNames = [
            ['name' => 'Sarah Johnson', 'email' => 'sarah.j@example.com'],
            ['name' => 'Mark Williams', 'email' => 'mark.w@example.com'],
            ['name' => 'Emma Thompson', 'email' => 'emma.t@example.com'],
            ['name' => 'James Patterson', 'email' => 'james.p@example.com'],
            ['name' => 'Lucy Chen', 'email' => 'lucy.c@example.com'],
            ['name' => 'David Brown', 'email' => 'david.b@example.com'],
            ['name' => 'Rachel Green', 'email' => 'rachel.g@example.com'],
            ['name' => 'Tom Harris', 'email' => 'tom.h@example.com'],
        ];

        // Create bookings for the first few events
        $events = Event::all();
        foreach ($events->take(5) as $event) {
            $numBookings = rand(2, 5);
            $shuffledNames = collect($sampleNames)->shuffle()->take($numBookings);

            foreach ($shuffledNames as $person) {
                $tickets = rand(1, 3);
                Booking::create([
                    'reference' => Booking::generateReference(),
                    'event_id' => $event->id,
                    'name' => $person['name'],
                    'email' => $person['email'],
                    'tickets' => $tickets,
                    'status' => 'confirmed',
                ]);
            }
        }
    }
}
