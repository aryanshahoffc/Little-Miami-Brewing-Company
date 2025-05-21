import { NextResponse } from 'next/server';

// This is a placeholder data array. In a real application, 
// you would fetch this data from your WordPress API
const reviews = [
  {
    id: '1',
    author: 'Sarah J.',
    content: 'Love the atmosphere! The craft beer selection is amazing, and the pizza is to die for. Perfect spot for a night out with friends.',
    rating: 5,
    date: '2023-05-15'
  },
  {
    id: '2',
    author: 'Mike R.',
    content: 'Best brewery in Cincinnati! The River Valley Lager is my go-to. Staff is super knowledgeable and friendly.',
    rating: 5,
    date: '2023-05-10'
  },
  {
    id: '3',
    author: 'Emily W.',
    content: 'We had our company event here and it was fantastic. Great venue, great beer, and the team was incredibly accommodating.',
    rating: 4,
    date: '2023-05-01'
  }
];

export async function GET() {
  // Filter reviews to only return those with 4 stars or higher
  const highRatedReviews = reviews.filter(review => review.rating >= 4);
  
  return NextResponse.json(highRatedReviews);
}
