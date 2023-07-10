import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'
@Entity({name: 'Post'})
export class Postentity{
  @PrimaryGeneratedColumn()
  id: number
  @Column({type: 'text'})
  content: srting

  @Column()
  userName:string
}