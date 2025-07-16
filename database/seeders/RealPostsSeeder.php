<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class RealPostsSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $categories = Category::all();
        
        if ($users->isEmpty()) {
            $this->command->error('No users found. Please create users first.');
            return;
        }

        $posts = [
            [
                'title' => 'The Future of Web Development: AI-Powered Tools Revolutionizing the Industry',
                'excerpt' => 'Discover how artificial intelligence is transforming web development, from automated code generation to intelligent debugging systems that are reshaping how we build the web.',
                'content' => '<h2>The AI Revolution in Web Development</h2>
<p>As we move further into 2024, artificial intelligence is no longer just a buzzword in the tech industry—it\'s actively reshaping how we approach web development. From automated code generation to intelligent debugging systems, AI-powered tools are becoming indispensable for developers worldwide.</p>

<h3>Code Generation and Autocompletion</h3>
<p>Modern AI coding assistants like GitHub Copilot and Amazon CodeWhisperer are revolutionizing the development workflow. These tools can:</p>
<ul>
<li>Generate entire functions based on comments</li>
<li>Provide intelligent code suggestions</li>
<li>Automatically detect and fix common bugs</li>
<li>Offer contextual documentation</li>
</ul>

<h3>Intelligent Testing and Debugging</h3>
<p>AI is also transforming how we test and debug applications. New tools can:</p>
<ul>
<li>Automatically generate test cases</li>
<li>Predict potential bugs before they occur</li>
<li>Provide intelligent error analysis</li>
<li>Suggest optimal performance improvements</li>
</ul>

<h3>The Impact on Developer Productivity</h3>
<p>Studies show that AI-powered development tools can increase developer productivity by up to 40%. This doesn\'t mean developers are being replaced—rather, they\'re being empowered to focus on more complex, creative aspects of development.</p>

<h3>Looking Ahead</h3>
<p>As AI continues to evolve, we can expect even more sophisticated tools that will further streamline the development process. The key is to embrace these technologies while maintaining the human creativity and problem-solving skills that make great developers.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Technology')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 8
            ],
            [
                'title' => 'Sustainable Living: 10 Simple Ways to Reduce Your Carbon Footprint',
                'excerpt' => 'Explore practical and achievable steps you can take today to live more sustainably and make a positive impact on our planet.',
                'content' => '<h2>Why Sustainable Living Matters</h2>
<p>Climate change is one of the most pressing issues of our time, and while the problem may seem overwhelming, every individual action counts. By making conscious choices in our daily lives, we can collectively create significant positive change.</p>

<h3>1. Reduce Energy Consumption</h3>
<p>Start by making your home more energy-efficient:</p>
<ul>
<li>Switch to LED light bulbs</li>
<li>Unplug electronics when not in use</li>
<li>Use energy-efficient appliances</li>
<li>Consider solar panels for your home</li>
</ul>

<h3>2. Rethink Transportation</h3>
<p>Transportation accounts for a significant portion of carbon emissions:</p>
<ul>
<li>Walk or bike for short trips</li>
<li>Use public transportation when possible</li>
<li>Consider carpooling or ride-sharing</li>
<li>If buying a car, choose electric or hybrid options</li>
</ul>

<h3>3. Mindful Consumption</h3>
<p>Every purchase we make has an environmental impact:</p>
<ul>
<li>Buy local and seasonal produce</li>
<li>Choose products with minimal packaging</li>
<li>Support companies with sustainable practices</li>
<li>Repair items instead of replacing them</li>
</ul>

<h3>4. Reduce Waste</h3>
<p>Waste reduction is crucial for sustainability:</p>
<ul>
<li>Compost organic waste</li>
<li>Recycle properly</li>
<li>Use reusable containers and bags</li>
<li>Choose products with recyclable packaging</li>
</ul>

<h3>5. Water Conservation</h3>
<p>Water is a precious resource:</p>
<ul>
<li>Fix leaky faucets</li>
<li>Install water-efficient fixtures</li>
<li>Collect rainwater for gardening</li>
<li>Take shorter showers</li>
</ul>

<h3>The Ripple Effect</h3>
<p>Remember, sustainable living isn\'t about perfection—it\'s about progress. Every small change you make can inspire others and create a ripple effect of positive environmental impact.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Environment')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 6
            ],
            [
                'title' => 'The Psychology of Color in Marketing: How Colors Influence Consumer Behavior',
                'excerpt' => 'Dive deep into the fascinating world of color psychology and discover how different hues can dramatically impact consumer decisions and brand perception.',
                'content' => '<h2>Understanding Color Psychology</h2>
<p>Color is one of the most powerful tools in marketing and design. It can evoke emotions, influence decisions, and create lasting impressions. Understanding the psychology behind colors is crucial for effective marketing strategies.</p>

<h3>Red: Energy and Urgency</h3>
<p>Red is associated with:</p>
<ul>
<li>Energy and excitement</li>
<li>Urgency and action</li>
<li>Passion and love</li>
<li>Attention-grabbing elements</li>
</ul>
<p>Brands like Coca-Cola and Netflix use red to create excitement and urgency.</p>

<h3>Blue: Trust and Stability</h3>
<p>Blue conveys:</p>
<ul>
<li>Trust and reliability</li>
<li>Professionalism</li>
<li>Stability and security</li>
<li>Calm and peace</li>
</ul>
<p>Financial institutions and tech companies often use blue to build trust.</p>

<h3>Green: Growth and Health</h3>
<p>Green represents:</p>
<ul>
<li>Growth and prosperity</li>
<li>Health and wellness</li>
<li>Nature and sustainability</li>
<li>Freshness and renewal</li>
</ul>
<p>Organic brands and health companies frequently use green.</p>

<h3>Yellow: Optimism and Clarity</h3>
<p>Yellow is associated with:</p>
<ul>
<li>Optimism and happiness</li>
<li>Clarity and focus</li>
<li>Energy and warmth</li>
<li>Attention and visibility</li>
</ul>
<p>Fast food chains and discount stores often use yellow.</p>

<h3>Purple: Luxury and Creativity</h3>
<p>Purple conveys:</p>
<ul>
<li>Luxury and sophistication</li>
<li>Creativity and imagination</li>
<li>Royalty and nobility</li>
<li>Mystery and spirituality</li>
</ul>
<p>Premium brands and creative industries favor purple.</p>

<h3>Cultural Considerations</h3>
<p>It\'s important to note that color meanings can vary across cultures. What\'s considered positive in one culture might be negative in another. Always research your target audience\'s cultural background.</p>

<h3>Practical Applications</h3>
<p>When choosing colors for your brand:</p>
<ul>
<li>Consider your brand personality</li>
<li>Think about your target audience</li>
<li>Test different color combinations</li>
<li>Ensure accessibility and readability</li>
</ul>',
                'featured_image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Marketing')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 7
            ],
            [
                'title' => 'Digital Nomad Lifestyle: How to Work Remotely While Traveling the World',
                'excerpt' => 'Learn the essential tips and strategies for becoming a successful digital nomad, from finding remote work to managing work-life balance on the road.',
                'content' => '<h2>The Rise of Digital Nomadism</h2>
<p>The digital nomad lifestyle has exploded in popularity, especially after the COVID-19 pandemic. With remote work becoming the new normal, more people are choosing to work from anywhere in the world.</p>

<h3>Essential Skills for Digital Nomads</h3>
<p>To succeed as a digital nomad, you need:</p>
<ul>
<li>Strong time management skills</li>
<li>Self-discipline and motivation</li>
<li>Adaptability to different environments</li>
<li>Good communication skills</li>
<li>Technical proficiency in your field</li>
</ul>

<h3>Finding Remote Work Opportunities</h3>
<p>There are numerous ways to find remote work:</p>
<ul>
<li>Freelance platforms (Upwork, Fiverr, Freelancer)</li>
<li>Remote job boards (Remote.co, WeWorkRemotely)</li>
<li>Company career pages</li>
<li>Networking and referrals</li>
<li>Starting your own business</li>
</ul>

<h3>Choosing Your Destinations</h3>
<p>When selecting destinations, consider:</p>
<ul>
<li>Internet connectivity and speed</li>
<li>Cost of living</li>
<li>Time zone differences</li>
<li>Safety and healthcare</li>
<li>Visa requirements and length of stay</li>
</ul>

<h3>Essential Tools and Equipment</h3>
<p>Pack these essentials:</p>
<ul>
<li>Reliable laptop and backup devices</li>
<li>Universal power adapter</li>
<li>Portable WiFi hotspot</li>
<li>Noise-canceling headphones</li>
<li>Travel insurance</li>
</ul>

<h3>Managing Work-Life Balance</h3>
<p>Maintaining balance is crucial:</p>
<ul>
<li>Set regular work hours</li>
<li>Create a dedicated workspace</li>
<li>Take regular breaks and explore</li>
<li>Stay connected with family and friends</li>
<li>Practice self-care routines</li>
</ul>

<h3>Financial Planning</h3>
<p>Smart financial planning is essential:</p>
<ul>
<li>Create a budget for each destination</li>
<li>Save for emergencies</li>
<li>Consider healthcare costs</li>
<li>Plan for taxes in different countries</li>
<li>Invest in your future</li>
</ul>

<h3>Building a Community</h3>
<p>Connect with other digital nomads:</p>
<ul>
<li>Join online communities and forums</li>
<li>Attend coworking spaces</li>
<li>Participate in local meetups</li>
<li>Use social media to connect</li>
<li>Share experiences and tips</li>
</ul>',
                'featured_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Lifestyle')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 9
            ],
            [
                'title' => 'The Art of Mindful Eating: Transform Your Relationship with Food',
                'excerpt' => 'Discover how practicing mindful eating can improve your health, relationship with food, and overall well-being through simple techniques and awareness.',
                'content' => '<h2>What is Mindful Eating?</h2>
<p>Mindful eating is the practice of being fully present and aware during the eating experience. It involves paying attention to the colors, smells, flavors, textures, temperatures, and even the sounds of our food.</p>

<h3>The Benefits of Mindful Eating</h3>
<p>Practicing mindful eating can lead to:</p>
<ul>
<li>Better digestion and nutrient absorption</li>
<li>Improved portion control</li>
<li>Enhanced enjoyment of food</li>
<li>Reduced stress and anxiety</li>
<li>Better relationship with food</li>
</ul>

<h3>Core Principles of Mindful Eating</h3>
<p>Mindful eating is based on several key principles:</p>
<ul>
<li>Eating without distraction</li>
<li>Listening to hunger and fullness cues</li>
<li>Appreciating the sensory experience</li>
<li>Understanding the emotional connection to food</li>
<li>Recognizing the impact of food choices</li>
</ul>

<h3>Practical Techniques to Get Started</h3>
<p>Begin your mindful eating journey with these simple steps:</p>

<h4>1. The Pause</h4>
<p>Before eating, take a moment to pause and breathe. This simple act helps you transition from your busy day to the eating experience.</p>

<h4>2. Engage Your Senses</h4>
<p>Take time to notice the appearance, smell, and texture of your food before taking the first bite.</p>

<h4>3. Slow Down</h4>
<p>Eat slowly and chew thoroughly. This allows your body to properly digest food and recognize when you\'re full.</p>

<h4>4. Remove Distractions</h4>
<p>Turn off the TV, put away your phone, and focus solely on your meal.</p>

<h3>Mindful Eating in Daily Life</h3>
<p>Incorporate mindful eating into your routine:</p>
<ul>
<li>Start with one meal per day</li>
<li>Practice during snacks</li>
<li>Be patient with yourself</li>
<li>Celebrate small victories</li>
<li>Keep a food journal</li>
</ul>

<h3>Overcoming Common Challenges</h3>
<p>Common obstacles and solutions:</p>
<ul>
<li>Busy schedules: Start with 5-minute mindful meals</li>
<li>Emotional eating: Practice self-compassion</li>
<li>Social pressure: Explain your practice to others</li>
<li>Perfectionism: Focus on progress, not perfection</li>
</ul>

<h3>The Long-term Impact</h3>
<p>With consistent practice, mindful eating can transform your relationship with food and lead to lasting positive changes in your health and well-being.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Health')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 8
            ],
            [
                'title' => 'The Future of Renewable Energy: Solar, Wind, and Beyond',
                'excerpt' => 'Explore the latest developments in renewable energy technology and how they\'re shaping the future of sustainable power generation worldwide.',
                'content' => '<h2>The Renewable Energy Revolution</h2>
<p>The world is undergoing a massive transformation in how we generate and consume energy. Renewable energy sources are becoming increasingly cost-effective and efficient, making them the preferred choice for new power generation capacity.</p>

<h3>Solar Energy: The Brightest Star</h3>
<p>Solar power continues to lead the renewable energy revolution:</p>
<ul>
<li>Dramatically falling costs (down 90% in the last decade)</li>
<li>Improving efficiency of photovoltaic cells</li>
<li>Innovative applications like solar roads and windows</li>
<li>Battery storage solutions for solar energy</li>
</ul>

<h3>Wind Power: Harnessing the Air</h3>
<p>Wind energy is experiencing rapid growth:</p>
<ul>
<li>Larger, more efficient turbines</li>
<li>Offshore wind farms with massive potential</li>
<li>Floating wind turbines for deep water</li>
<li>Community wind projects</li>
</ul>

<h3>Emerging Technologies</h3>
<p>Several promising technologies are on the horizon:</p>

<h4>1. Tidal and Wave Energy</h4>
<p>Ocean energy has enormous potential, with predictable and consistent power generation.</p>

<h4>2. Geothermal Energy</h4>
<p>Enhanced geothermal systems can provide reliable, baseload power.</p>

<h4>3. Hydrogen Fuel Cells</h4>
<p>Green hydrogen production using renewable energy could revolutionize transportation and industry.</p>

<h4>4. Nuclear Fusion</h4>
<p>While still in development, fusion could provide unlimited clean energy.</p>

<h3>Energy Storage Solutions</h3>
<p>Storage is crucial for renewable energy success:</p>
<ul>
<li>Advanced battery technologies</li>
<li>Pumped hydro storage</li>
<li>Compressed air energy storage</li>
<li>Thermal energy storage</li>
</ul>

<h3>Smart Grid Technology</h3>
<p>Modernizing the electrical grid is essential:</p>
<ul>
<li>Real-time monitoring and control</li>
<li>Demand response programs</li>
<li>Distributed energy resources</li>
<li>Grid resilience and reliability</li>
</ul>

<h3>Economic and Environmental Benefits</h3>
<p>Renewable energy offers numerous advantages:</p>
<ul>
<li>Job creation in manufacturing and installation</li>
<li>Reduced air pollution and health benefits</li>
<li>Energy independence and security</li>
<li>Stable, predictable energy costs</li>
</ul>

<h3>Challenges and Solutions</h3>
<p>Addressing key challenges:</p>
<ul>
<li>Grid integration and stability</li>
<li>Energy storage for intermittent sources</li>
<li>Infrastructure development</li>
<li>Policy and regulatory support</li>
</ul>

<h3>Looking to the Future</h3>
<p>As technology continues to advance and costs decline, renewable energy will become the dominant form of power generation worldwide, creating a cleaner, more sustainable future for all.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Technology')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 10
            ],
            [
                'title' => 'Building Resilience: How to Bounce Back from Life\'s Challenges',
                'excerpt' => 'Learn practical strategies for developing mental and emotional resilience to help you navigate life\'s inevitable ups and downs with strength and grace.',
                'content' => '<h2>Understanding Resilience</h2>
<p>Resilience is the ability to adapt and bounce back from adversity, trauma, tragedy, threats, or significant sources of stress. It\'s not about avoiding difficult situations, but rather developing the capacity to recover and grow from them.</p>

<h3>The Science of Resilience</h3>
<p>Research shows that resilience is not a fixed trait but a skill that can be developed:</p>
<ul>
<li>Neuroplasticity allows our brains to adapt</li>
<li>Social connections strengthen resilience</li>
<li>Positive thinking patterns can be learned</li>
<li>Physical health supports mental resilience</li>
</ul>

<h3>Building Mental Resilience</h3>
<p>Develop mental toughness through these practices:</p>

<h4>1. Cognitive Reframing</h4>
<p>Learn to view challenges as opportunities for growth rather than insurmountable obstacles.</p>

<h4>2. Emotional Regulation</h4>
<p>Practice techniques like deep breathing, meditation, and mindfulness to manage emotions effectively.</p>

<h4>3. Problem-Solving Skills</h4>
<p>Break down large problems into smaller, manageable steps.</p>

<h4>4. Optimistic Thinking</h4>
<p>Cultivate a realistic but positive outlook on life\'s challenges.</p>

<h3>Physical Resilience</h3>
<p>Your physical health directly impacts your mental resilience:</p>
<ul>
<li>Regular exercise reduces stress hormones</li>
<li>Quality sleep improves emotional regulation</li>
<li>Proper nutrition supports brain function</li>
<li>Stress management techniques</li>
</ul>

<h3>Social Support Networks</h3>
<p>Strong relationships are crucial for resilience:</p>
<ul>
<li>Build meaningful connections</li>
<li>Seek support when needed</li>
<li>Offer support to others</li>
<li>Join community groups</li>
</ul>

<h3>Developing a Growth Mindset</h3>
<p>Embrace challenges as opportunities for learning:</p>
<ul>
<li>View failures as learning experiences</li>
<li>Celebrate effort and progress</li>
<li>Learn from feedback and criticism</li>
<li>Embrace change and uncertainty</li>
</ul>

<h3>Practical Resilience Strategies</h3>
<p>Daily practices to build resilience:</p>
<ul>
<li>Maintain a daily routine</li>
<li>Practice gratitude journaling</li>
<li>Set realistic goals</li>
<li>Take care of your physical health</li>
<li>Develop coping mechanisms</li>
</ul>

<h3>Seeking Professional Help</h3>
<p>It\'s important to recognize when you need additional support:</p>
<ul>
<li>Therapy and counseling</li>
<li>Support groups</li>
<li>Mental health professionals</li>
<li>Life coaches and mentors</li>
</ul>

<h3>The Journey of Resilience</h3>
<p>Remember that building resilience is a lifelong journey. Each challenge you face and overcome makes you stronger and more capable of handling future difficulties.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Psychology')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 9
            ],
            [
                'title' => 'The Evolution of E-commerce: From Simple Stores to AI-Powered Shopping Experiences',
                'excerpt' => 'Trace the fascinating journey of e-commerce from its humble beginnings to the sophisticated, AI-driven shopping experiences of today and tomorrow.',
                'content' => '<h2>The Early Days of E-commerce</h2>
<p>E-commerce has come a long way since the first online transaction in 1994. What started as simple online catalogs has evolved into sophisticated, personalized shopping experiences powered by artificial intelligence and machine learning.</p>

<h3>The First Wave: Basic Online Stores</h3>
<p>The early 2000s saw the emergence of basic e-commerce platforms:</p>
<ul>
<li>Simple product catalogs</li>
<li>Basic shopping cart functionality</li>
<li>Limited payment options</li>
<li>Basic search capabilities</li>
</ul>

<h3>The Mobile Revolution</h3>
<p>The rise of smartphones transformed e-commerce:</p>
<ul>
<li>Mobile-optimized websites</li>
<li>Native mobile apps</li>
<li>Touch-friendly interfaces</li>
<li>Location-based services</li>
</ul>

<h3>AI and Personalization</h3>
<p>Artificial intelligence has revolutionized online shopping:</p>

<h4>1. Personalized Recommendations</h4>
<p>AI algorithms analyze user behavior to suggest relevant products, increasing conversion rates and customer satisfaction.</p>

<h4>2. Chatbots and Virtual Assistants</h4>
<p>24/7 customer support through intelligent chatbots that can handle complex queries and provide personalized assistance.</p>

<h4>3. Visual Search</h4>
<p>AI-powered image recognition allows customers to search for products using photos, making discovery more intuitive.</p>

<h4>4. Voice Commerce</h4>
<p>Voice-activated shopping through smart speakers and virtual assistants.</p>

<h3>Augmented Reality and Virtual Reality</h3>
<p>Immersive technologies are transforming the shopping experience:</p>
<ul>
<li>Virtual try-on for clothing and cosmetics</li>
<li>AR furniture placement in homes</li>
<li>Virtual store tours</li>
<li>Interactive product demonstrations</li>
</ul>

<h3>Social Commerce</h3>
<p>The integration of social media and e-commerce:</p>
<ul>
<li>Shoppable posts and stories</li>
<li>Live shopping events</li>
<li>Social proof and reviews</li>
<li>Influencer partnerships</li>
</ul>

<h3>Omnichannel Experiences</h3>
<p>Seamless integration across all touchpoints:</p>
<ul>
<li>Unified customer data</li>
<li>Consistent experiences</li>
<li>Cross-channel inventory</li>
<li>Integrated loyalty programs</li>
</ul>

<h3>The Future of E-commerce</h3>
<p>Emerging trends that will shape the future:</p>

<h4>1. Hyper-Personalization</h4>
<p>AI will create increasingly personalized experiences based on real-time data and predictive analytics.</p>

<h4>2. Sustainability Focus</h4>
<p>Eco-friendly packaging, carbon-neutral shipping, and sustainable product options will become standard.</p>

<h4>3. Cryptocurrency Payments</h4>
<p>Digital currencies will become more mainstream for online transactions.</p>

<h4>4. Autonomous Delivery</h4>
<p>Drones and autonomous vehicles will revolutionize last-mile delivery.</p>

<h3>Challenges and Opportunities</h3>
<p>As e-commerce evolves, businesses must address:</p>
<ul>
<li>Data privacy and security</li>
<li>Cybersecurity threats</li>
<li>Supply chain optimization</li>
<li>Customer experience innovation</li>
</ul>

<h3>Preparing for the Future</h3>
<p>To stay competitive, businesses should:</p>
<ul>
<li>Invest in AI and machine learning</li>
<li>Embrace mobile-first strategies</li>
<li>Focus on customer experience</li>
<li>Adopt sustainable practices</li>
<li>Stay agile and adaptable</li>
</ul>',
                'featured_image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop',
                'category_id' => $categories->where('name', 'Business')->first()->id ?? $categories->random()->id,
                'status' => 'published',
                'reading_time' => 11
            ]
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'featured_image' => $postData['featured_image'],
                'category_id' => $postData['category_id'],
                'user_id' => $users->random()->id,
                'status' => $postData['status'],
                'reading_time' => $postData['reading_time'],
                'published_at' => now()->subDays(rand(1, 30)),
                'view_count' => rand(50, 5000)
            ]);

            // Add some comments to each post
            $commentCount = rand(2, 8);
            for ($i = 0; $i < $commentCount; $i++) {
                $post->comments()->create([
                    'content' => $this->getRandomComment(),
                    'user_id' => $users->random()->id,
                    'created_at' => now()->subDays(rand(1, 20)),
                    'updated_at' => now()->subDays(rand(1, 20))
                ]);
            }

            // Add some post views
            $viewCount = rand(100, 3000);
            for ($i = 0; $i < $viewCount; $i++) {
                $post->views()->create([
                    'ip_address' => '192.168.1.' . rand(1, 255) . '.' . rand(1, 255),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/' . rand(90, 120) . '.0.' . rand(1000, 9999) . '.' . rand(100, 999),
                    'created_at' => now()->subDays(rand(1, 30))
                ]);
            }
        }

        $this->command->info('Real posts created successfully!');
    }

    private function getRandomComment()
    {
        $comments = [
            'Great article! This really helped me understand the topic better.',
            'Thanks for sharing this valuable information.',
            'I\'ve been looking for something like this. Very helpful!',
            'Interesting perspective. I never thought about it this way.',
            'This is exactly what I needed. Bookmarked for future reference.',
            'Well written and informative. Looking forward to more content like this.',
            'Thanks for the insights. This gives me a lot to think about.',
            'Excellent breakdown of the topic. Very comprehensive.',
            'I appreciate the practical tips included in this post.',
            'This article really resonated with me. Great job!',
            'Very informative and well-researched. Thanks for sharing.',
            'I learned something new today. Thanks for the education.',
            'This is a topic I\'m passionate about. Great to see it covered here.',
            'The examples really helped clarify the concepts. Well done!',
            'I\'ll definitely be implementing some of these ideas.',
            'Thanks for making this complex topic so accessible.',
            'Great read! Looking forward to your next post.',
            'This is exactly the kind of content I love to read.',
            'Very practical and actionable advice. Thank you!',
            'I shared this with my team. Everyone found it useful.'
        ];

        return $comments[array_rand($comments)];
    }
} 